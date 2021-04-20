---
extends: _layouts.post
section: content
title: "Getting Started with Web Development: Intro to Javascript"
excerpt: A crash course of js, everything you need to get started with adding whole lot of awesome to your web pages. 
date: 2021-03-30
categories: [basics]
---

Javascript is the most popular programming language in the world.

In 2007, Jeff Atwood made the quote that was popularly referred to as Atwood’s Law. “Any application that can be written in JavaScript, will eventually be written in JavaScript.” 

Jeff Atwood is one of the founder of Stack Overflow.

Javascript is probably the most versatile language out there. It can be used to create websites, web applications, create mobile applications and even a server side application.

JavaScript was introduced in 1995 as a way to add programs to web pages in the Netscape Navigator browser. The language has since been adopted by all other major graphical web browsers. It has made modern web applications possible— applications with which you can interact directly without doing a page reload for every action. JavaScript is also used in more traditional websites to provide various forms of interactivity and cleverness. 

After its adoption outside of Netscape, a standard document was written to describe the way the JavaScript language should work so that the various pieces of software that claimed to support JavaScript were actually talking about the same language. This is called the ECMAScript standard, after the Ecma International organization that did the standardization. In practice, the terms ECMAScript and JavaScript can be used interchangeably—they are two names for the same language.

## Basics and Syntax 

### Variables

A variable is a value is assigned to an identifier. JavaScript variables are containers for storing data values. For example 
` a = 1; ` 

Hear the letter ‘a’ is the identifier. In programming, just like in algebra, we use variables (like a, b, count) to hold values. In JavaScript, we can define variables in two ways using const, var and let. 

const defines a constant reference to a value. This means the reference cannot be changed. You cannot reassign a new value to it. 

Using let you can assign a new value to it. Var should no longer be used in modern codebases, as it was replaced by let.

```

const a = 0
a = 1 // leads to error as you can't reassign a const

let a = 0
a = 1 // works


// multiple assignments
const a = 1, b = 2
let c = 1, d = 2

```

When you say something like,`const a = 2;`  two things are happening here,

1. Variable is initialized or declared - which is same as just saying `const a;`
2. Variable is assigned to the value 2. `a = 2;`

You can’t declare a variable twice and this leads to the duplicate declaration” error.


### Types
Like some other programming languages variables in js have no type attached. The variable’s type is decided when we assign a value to the variable.

Javascript has the following types:
- Primitive
	- numbers (1, -1 , 9000992 etc.)
	- strings (a set of characters like ‘word’, ’new’ etc.)
	- booleans (true or false)
	- symbols
- Special
	- null
	- undefined
- Objects

### Operators and Expressions
Expressions in js are a single unit of code that can be evaluated. Operators are used to combine two simple expressions and create complex expressions.

```
// primary or simple expressions
10
'abc'
true
null
```

Types of Operators
- arithmetic
```
1 + 2
a + 1
a * (2 / 3)
```

- logical
```
a || b // OR
a && b // AND
!a // NOT
```

- string
`’My name’ + ‘ ‘ +’is slim shady.’ // concatenation`

- comparison -  always return a boolean
```
let a = 10;
let b = 20;

a > b // a is greater than b? - false
a < b // a is less than b? - true

a >= b // a is greater than or equal to b? - false
a <= b // a is less than or equal to b? - true

a === b // a is equal to b? - false
a !== b // a is not equal to b? - true
```


### Conditionals

Comparison operators are used to make comparisons between different variable, there are times when we need to perform unique actions based on a different conditions. 
An if statement is used to make the program take one route, or another, depending on the result of an expression evaluation. 

```
if (true) {
  //do something
}

on the contrary, this is never executed:
if (false) {
  //do something that will never happen
}

if (a === true) {
  //do something
} else if (b === true) {
  //do something else
} else {
  //fallback
}

```



### Arrays
An array is a collection of elements. It’s a very commonly used datatype in programming.

In js, we can initialize a array like this,

```

const a = []
const a = Array()

```

In js arrays are of type object and can hold any type of value. To assign values to an array we can do something like:

` const a = [10, 'yoyoma', ['a', 10]];`

We access a value or an element of the array by referencing its index, which starts from zero.

**Array Operations**

` const arr = [1, 2, 3, 4, 5];`

- Find array length - `arr.length // 5`
- Add item to array - `arr.push(6); // arr is now [1, 2, 3, 4, 5, 6]`
- Remove items from array
 `arr.pop() // remove last element`
 `arr.shift() // remove first element`
- Join two or more arrays - `arr.concat(anotherArray);`


### String
A string is a sequence of characters, it is always enclosed in a single quote or a double quote.

`const message = ‘New string here’;`

**Basic String Operations**
- Find string length - `message.length`
- Join strings using ‘+’ - `message + ‘ and a new message’`
- Change string case - `message.toLowerCase();message.toUpperCase();` 

### Loops
Loops are a way to repeat some piece of code based on a condition. Looping in programming languages is a feature which facilitates the execution of a set of instructions/functions repeatedly based on a condition.

Most commonly we use three types of loops:
- while
This is the simplest one. We just add a condition to while just like if and it keeps repeating the code block until the condition is true.

```
while(true){
	// do something forever
}

const arr = [1, 2, 3, 4];
let i = 0;
while (i < arr.length) {
  console.log(arr[i]); //value
  console.log(i); //index
  i = i + 1;
}

```

- for
We use the for keyword and we pass a set of 3 instructions: the initialization, the condition, and the increment part.

```
const arr = ['a', 'b', 'c'];

for (let i = 0; i < arr.length; i++) {
  console.log(arr[i]); //value
  console.log(i); //index
}

```

- for of
This is a simplified version of ‘for’ loops, and it works great with arrays.

```
const arr = ['a', 'b', 'c', 'd'];

for (const element of arr) {
  console.log(element); //value
}
```


### Functions
A function is a self contained block of code.  A function is a block of organized, reusable code that is used to perform a single, related action. Functions provide better modularity for your application and a high degree of code reusing.

A function can have zero or more arguments.


```

// DECLARATION
function getData() {
  //do something
}

getData();


// DECLARATION
function getData(id) {
  //do something
}

getData(1);


// DECLARATION
function getData(id, name) {
  //do something
}

getData(1, 'rish');
```

We can pass a default value for a parameter which is used in case a parameter is not given during the call. 

A function can have a return value which can be assigned to a variable.

```
function doubleAge(age = 18) {
	return age * 2;
}

var newAge = doubleAge(); // age will be 36

```


### Objects
Any value that’s not of a primitive type is an object in js. So, an array or a string both are objects of type array and string respectively. 

Objects in JavaScript can be defined as an unordered collection of related data, of primitive or reference types, in the form of “key: value” pairs. These keys can be variables or functions and are called properties and methods, respectively, in the context of an object.

We can define an object like this,

```

const person = {};

// or

const person = new Object();


// assigning values to object

const person = {
	name: 'Rish',
	age: 25,
};

// Get or reset a value:

person.name ;  // object style 	
person['name'];  // array style notation

person.name = 'Rish Pandey';


// Add another property to object
person.profession = 'Full time Trainer - Part time Ninja';

```

Call By Value: In this parameter passing method, values of actual parameters are copied to function’s formal parameters and the two types of parameters are stored in different memory locations. So any changes made inside functions are not reflected in actual parameters of caller.

Call by Reference: Both the actual and formal parameters refer to same locations, so any changes made inside the function are actually reflected in actual parameters of caller.

If you pass an object to a function it is always passed by reference.


### Scope
Scope is the set of variable which are visible or available to a part of program. 

There are three scopes available in js:

- global scope 
If a variable is declared outside a function or a block it’s attached to the global scope and is available to every part of the code. 
Global variables can be altered by any part of the code, making it difficult to remember or reason about every possible use. A global variable can have no access control. It can not be limited to some part of the program.

- block scope 
A block is a set of instructions grouped into a pair of curly braces, like the ones we can find inside an if statement, a for loop, or a function. These variables are only available within the current block. Using ‘var’ does not work with block scope and assigns the variable to a function scope, that’s why it is recommended to use const or let.

- function scope
If a variable is defined in the main block of a function or is passed as a parameter to the function, it is in the function scope. These variables are available in the whole function.


```

const a = 10; // global scope

function do(param){
	param; // function scope

	let b = 5; // function scope

	if(true){
		let c = 20; // block scope
		var d = 30; // function scope
	}
}

```




### Errors
Errors and exceptions usually occur when something doesn’t go as planned.  There are three types of errors in programming: 

- Syntax Errors
These are errors that occur during compiling or interpreting. If a piece or code is not written correctly then it is not possible for the javascript engine to make sense of it.

For example, `let b = ;`  this will lead to 
`Uncaught SyntaxError: Unexpected token ';'` which means that the there was a syntax error in the code and the semicolon was found where something else (like a number, string, object etc.) was expected.

These types of errors are easiest to debug as the engine tells us exactly what is wrong and where.

- Runtime Errors
Runtime errors occur during the execution of code, also called exceptions. What this means is that the engine was able to compile the code and the error was found while executing the code.

`console.logger('throw an exception');`

There is a console.log method used to log messages in the browser console but ‘logger’ does not exist on the console object. This will throw an exception `Uncaught TypeError: console.logger is not a function`.

- Logical Errors
Logic errors are the most difficult type of errors to track down. These errors are not the result of a syntax or runtime error like an exception. They are not marked as errors anywhere in the browser and occur when we make a mistake in the logic that drives our script and you do not get the result you expected.

## DOM and Events

DOM or the Document Object Model represents the HTML document where the script is loaded. It is used to add or change behavior of HTML elements.

A Web page is a document. This document can be either displayed in the browser window or as the HTML source. DOM represents that same document so it can be manipulated. The DOM is an object-oriented representation of the web page, which can be modified with a scripting language such as JavaScript.


Common method for DOM access and manipulation:

Getting elements
To perform actions on an element like changing the HTML, modifying attributes or adding an event, we first need to get the element into a our script.

There are several ways to do that

- document.getElementById(id) - used to get a single element by its id attribute.
- document.getElementsByTagName(name) - used to get an array of all elements by the given tag.
- document.getElementsByClassName(class) - used to get elements by giving an id.

Creating nodes
- document.createElement(name) - used to create a node by passing tag name.
- parentNode.appendChild(node) - used to append the created node to a parent element.

```
// Create a <button> element
var btn = document.createElement("BUTTON");   

// Insert HTML between <button> and </button>
btn.innerHTML = "CLICK ME";     

// Append <button> to <body>
document.body.appendChild(btn);

// Or append <button> to an element
let container = document.getElementById('div-1');
container.appendChild(btn);

// or shorthand
document.getElementById('div-1').appendChild(btn);

```

Element content
- element.innerHTML - This property is used to modify HTML content of an element. You can also insert or nest another element inside an element using this. 
- element.innerText - This changes the text content of an element. 

Element Styling
- element.style - used to modify the element CSS using js. This is used very commonly and supports all the properties of CSS.

```
let button = document.getElementById('button-1');

el.style.color = 'red'; // sets font color red
el.style.borderColor = 'blue'; // sets the border-color
el.style.borderStyle = 'solid'; // sets the border-styke
```

Element Attributes
We can also add, remove and modify element attributes using js.

- element.setAttribute( attributeName , value ) - sets or adds the attribute with a given value.
- element.removeAttribute(attributeName) - removes an attribute from the element.
- element.getAttribute(attributeName) - returns the value of given attribute.

Events
- element.addEventListener()
 The method addEventListener() sets up a function that will be called whenever the specified event is delivered to the target. We can call this on an element, the document, the window or any target that supports events.

`target.addEventListener(type, listener, [options]);`

There are many types of listener types available like:
- click
- keydown
- keyup
- keypress
- mousedown
- mouse

To attach a listener to any element we can do something like:

```

let el = document.getElementById('element-1');

function clickHandlerFunction(){
	// do something
}

el.addEventListener('click', clickHandlerFunction);

```

- element.removeEventListener()
An event listener added by calling addEventListener() can be removed by using element.removeEventListener. 

```
element.removeEventListener("click", clickHandlerFunction);
```


Window Object Methods
- window.onload
This can be used to attach a method which will be executed ones the whole document is loaded.

```
<html>

...

<script>
window.onload = function() {
	// do something when everything is loaded
}
</script>

<body>
...
</body>

</html>
```

- window.scrollTo()
Scrolls the document to the specified coordinates

- window.localStorage
Allows to save key/value pairs in a web browser. Stores the data with no expiration date. You can store any information using localStorage and it will be available forever unless the user deletes the browser data for the website.

```
// localStorage.setItem(key, value);
localStorage.setItem('id', 10002);

const id = localStorage.getItem('id'); 
// id is 10002

```


*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*

<style>
p > strong:first-child {
    text-transform: uppercase;
	display: block;
    margin-top: 30px;
}
</style>
