---
extends: _layouts.post
section: content
title: "Let's build a Virtual DOM in JS from scratch"
date: 2024-09-15
featured: true
categories: [vue, js]
---

A while ago, I wanted to really understand how modern UI libraries like Vue manage efficient rendering. So, I decided to challenge myself by **creating my own Virtual DOM library**. In this article, we will see how to do build our own Virtual DOM and use it to create a basic Todo list app.

## Creating the Virtual DOM Library

### Step 1: Setting Up the Project

First, I created a new directory for my library:

```bash
mkdir mini-vdom
cd mini-vdom
npm init -y
```

This initializes a new npm package with default settings.

### Step 2: Implementing the Virtual DOM

I wanted the library to be minimal yet functional. Here's how I structured it.

#### **1. Defining Virtual Nodes (VNodes)**

Why do we need to define Virtual Nodes (VNodes)?

Manipulating the actual DOM directly for every little change is a recipe for poor performance. The DOM is slow, and updating it frequently can make the UI laggy, which is not what we want.

We need a way to represent the UI components in a lightweight, efficient manner before committing any changes to the real DOM. That's where Virtual Nodes, or VNodes, come into play. 

By defining VNodes, we're essentially creating plain JavaScript objects that mirror the structure of actual DOM elements. These VNodes contain information about the element type, its properties (like attributes and event listeners), and its children.

```javascript
// src/h.js
function h(type, props, ...children) {
  return { type, props: props || {}, children };
}

module.exports = { h };
```


#### **2. Rendering VNodes to the Real DOM**

After setting up our VNodes, the next challenge was figuring out how to turn these virtual nodes into actual DOM elements that the browser can display. Since VNodes are just JavaScript objects representing the structure of my UI, we need a way to translate them into real DOM nodes.

```javascript
// src/render.js
function render(vNode) {
  if (typeof vNode === 'string') {
    return document.createTextNode(vNode);
  }

  const $el = document.createElement(vNode.type);

  // Set properties
  for (const [key, value] of Object.entries(vNode.props)) {
    if (key.startsWith('on')) {
      $el.addEventListener(key.substring(2).toLowerCase(), value);
    } else {
      $el.setAttribute(key, value);
    }
  }

  // Render and append children
  vNode.children
    .map(render)
    .forEach(child => $el.appendChild(child));

  return $el;
}

module.exports = { render };
```

#### **3. Implementing the Diffing Algorithm**

After getting the VNodes rendering on the page, the next big challenge is efficiently updating the DOM when the application state changes. I didn't want to re-render the entire UI every time something changed—that would be inefficient and could cause performance issues.

This is where the diffing algorithm comes into play. The idea is to compare the new Virtual DOM tree with the previous one, figure out what has changed, and update only those parts in the real DOM.

#### Implementing the Diffing Algorithm

After getting the VNodes rendering on the page, I faced the next big challenge: **efficiently updating the DOM when the application state changes**. I didn't want to re-render the entire UI every time something changed—that would be inefficient and could cause performance issues.

This is where the **diffing algorithm** comes into play. The idea is to compare the new Virtual DOM tree with the previous one, figure out what has changed, and update only those parts in the real DOM.

So, I rolled up my sleeves and started working on a `diff.js` file.

##### Why do we need a diffing algorithm?

When the state of our application changes (like when a user adds a new todo item), we generate a new Virtual DOM tree representing the updated UI. However, we need a way to efficiently update the actual DOM to reflect these changes without re-rendering everything.

The diffing algorithm helps us:

- **Identify changes** between the old and new Virtual DOM trees.

- **Minimize DOM manipulations** by only updating what has changed.

- **Improve performance** by avoiding unnecessary re-renders.


```javascript
// src/diff.js
function diff(oldVNode, newVNode) {
  if (newVNode === undefined) {
    return ($node) => {
      $node.remove();
      return undefined;
    };
  }

  if (typeof oldVNode === 'string' || typeof newVNode === 'string') {
    if (oldVNode !== newVNode) {
      return ($node) => {
        const $newNode = render(newVNode);
        $node.replaceWith($newNode);
        return $newNode;
      };
    } else {
      return ($node) => $node;
    }
  }

  if (oldVNode.type !== newVNode.type) {
    return ($node) => {
      const $newNode = render(newVNode);
      $node.replaceWith($newNode);
      return $newNode;
    };
  }

  const patchProps = diffProps(oldVNode.props, newVNode.props);
  const patchChildren = diffChildren(oldVNode.children, newVNode.children);

  return ($node) => {
    patchProps($node);
    patchChildren($node);
    return $node;
  };
}

function diffProps(oldProps, newProps) {
  const patches = [];

  // Set new or changed props
  for (const [key, value] of Object.entries(newProps)) {
    patches.push(($node) => {
      $node.setAttribute(key, value);
      return $node;
    });
  }

  // Remove old props
  for (const key in oldProps) {
    if (!(key in newProps)) {
      patches.push(($node) => {
        $node.removeAttribute(key);
        return $node;
      });
    }
  }

  return ($node) => {
    for (const patch of patches) {
      patch($node);
    }
  };
}

function diffChildren(oldVChildren, newVChildren) {
  const childPatches = [];
  oldVChildren.forEach((oldChild, i) => {
    childPatches.push(diff(oldChild, newVChildren[i]));
  });

  const additionalPatches = [];
  for (const additionalVChild of newVChildren.slice(oldVChildren.length)) {
    additionalPatches.push(($node) => {
      $node.appendChild(render(additionalVChild));
      return $node;
    });
  }

  return ($parent) => {
    $parent.childNodes.forEach(($child, i) => {
      childPatches[i]($child);
    });

    for (const patch of additionalPatches) {
      patch($parent);
    }

    return $parent;
  };
}

module.exports = { diff };
```

1. **How I implemented the `diff` function**

   - I started by writing a `diff` function that takes two VNodes—the old one and the new one—and returns a function (which I call a "patch") that can update the real DOM accordingly. Let me break down what this function does:

     1. **Node Removal**: If `newVNode` is `undefined`, it means the node has been removed in the new tree. So, we return a patch function that removes the corresponding real DOM node.

     2. **Text Nodes**: If either `oldVNode` or `newVNode` is a string (text node), and they are different, we replace the old text node with the new one.

     3. **Different Node Types**: If the `type` of the old and new VNodes are different (e.g., `div` vs. `span`), we can't reconcile them, so we replace the whole node.

     4. **Same Node Types**: If the nodes are of the same type, we need to:

        - **Diff the props**: Compare the attributes and event listeners.
        - **Diff the children**: Recursively apply the diffing process to child nodes.

2. **Diffing Props**

   - To diff the props correctly, we need to do a few things:

     - **Setting New and Updated Props**: We iterate over `newProps` and create patches that set these attributes on the real DOM node.

     - **Removing Old Props**: We check for any props that were present in `oldProps` but are missing in `newProps` and create patches to remove them.

     - **Applying the Patches**: We return a function that, when called with a DOM node, applies all these patches.

3. **Diffing Children**

   - Children are a bit trickier since they are arrays of VNodes. We need to:

     - **Create Child Patches**: Go through each pair of old and new children and generate patches using the `diff` function recursively.

     - **Handle Additional Children**: If there are more new children than old ones, create patches to add these new children to the DOM.

     - **Apply Child Patches**: The returned function applies all the child patches to the parent DOM node.

4. **Applying the Patches**

   - Finally, we need a way to apply these patches to update the DOM. This is where the `patch()` method comes in.

   - When the application state changes, we can now generate a new VNode, diff it with the old one, and apply the resulting patches.


#### **4. Putting It All Together**

Finally, we export all the functions:

```javascript
// index.js
const { h } = require('./src/h');
const { render } = require('./src/render');
const { diff } = require('./src/diff');

module.exports = { h, render, diff };
```


### Step 3: Preparing for Packaging

I updated the `package.json` to include the main entry point:

```json
{
  "name": "mini-vdom",
  "version": "1.0.0",
  "main": "index.js",
  "license": "MIT"
}
```


### Step 4: Publishing Locally

For testing purposes, I used `npm link` to make this package available globally:

```bash
npm link
```

---

## Using the Virtual DOM Library in a Project

Now, let's create a new project and use our `mini-vdom` library to render a Todo List.

### Step 1: Setting Up the Todo List Project

```bash
mkdir todo-app
cd todo-app
npm init -y
```

### Step 2: Installing the `mini-vdom` Package

Since we used `npm link`, we can link it in our project:

```bash
npm link mini-vdom
```

Alternatively, if you publish it to npm, you can install it via:

```bash
npm install mini-vdom
```

### Step 3: Creating the Application Files

#### **1. HTML File**

Create an `index.html` file:

```html
<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
  <title>Todo List</title>
</head>
<body>
  <div id="app"></div>
  <script src="app.js"></script>
</body>
</html>
```

#### **2. JavaScript File**

Create an `app.js` file:

```javascript
// app.js
const { h, render, diff } = require('mini-vdom');

let todos = [];
let filter = 'all';

function view(todos, filter) {
  const filteredTodos = todos.filter(todo => {
    if (filter === 'all') return true;
    return filter === 'completed' ? todo.completed : !todo.completed;
  });

  return h('div', null,
    h('h1', null, 'Todo List'),
    h('input', { type: 'text', id: 'new-todo', placeholder: 'What needs to be done?' }),
    h('button', { onclick: addTodo }, 'Add'),
    h('ul', null, ...filteredTodos.map(todoItem)),
    h('div', null,
      h('button', { onclick: () => setFilter('all') }, 'All'),
      h('button', { onclick: () => setFilter('active') }, 'Active'),
      h('button', { onclick: () => setFilter('completed') }, 'Completed'),
    )
  );
}

function todoItem(todo, index) {
  return h('li', null,
    h('input', {
      type: 'checkbox',
      checked: todo.completed,
      onchange: () => toggleTodo(index)
    }),
    h('span', null, todo.text),
    h('button', { onclick: () => removeTodo(index) }, 'Delete')
  );
}

function addTodo() {
  const input = document.getElementById('new-todo');
  if (input.value.trim() === '') return;
  todos.push({ text: input.value.trim(), completed: false });
  input.value = '';
  update();
}

function toggleTodo(index) {
  todos[index].completed = !todos[index].completed;
  update();
}

function removeTodo(index) {
  todos.splice(index, 1);
  update();
}

function setFilter(value) {
  filter = value;
  update();
}

let vNode = view(todos, filter);
let $rootEl = render(vNode);
const $app = document.getElementById('app');
$app.appendChild($rootEl);

function update() {
  const newVNode = view(todos, filter);
  const patches = diff(vNode, newVNode);
  $rootEl = patches($rootEl);
  vNode = newVNode;
}
```

### Step 4: Setting Up a Development Server

To serve the application, I used a simple static server. You can install one globally:

```bash
npm install -g serve
```

Run the server:

```bash
serve .
```

This will start a server at `http://localhost:5000` (or another port if 5000 is in use).

---

## Further Enhancements

There are several ways to improve this library:

- **Event Delegation**: Optimize event handling.
- **Keyed Diffing**: Improve the diffing algorithm by using keys.
- **Component Structure**: Introduce components for better organization.
- **State Management**: Implement a more robust state management system.

---


Building this Virtual DOM library and using it in a real project was a fantastic learning experience. It gave me deeper insights into how libraries like React manage efficient updates and state management. 