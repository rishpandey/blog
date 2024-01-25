---
extends: _layouts.post
section: content
title: "Vue Tip #1: Getting vuex store instance on production in Vue3"
date: 2024-01-16
featured: false
categories: [vue]
---

Copy and paste the code below in the developer console and you will get the instace of Vuex on any website using vuex. And yes it works on production.

```javascript
Array.from(document.querySelectorAll('*'))
    .find(e => e.__vue_app__)
    .__vue_app__.config.globalProperties.$store.state
```

## Here's a breakdown of how it works:

1. `document.querySelectorAll('*')`: This selects all elements in the DOM.

2. `Array.from(...)`: Converts the NodeList returned by `querySelectorAll` into a JavaScript array, which allows the use of array methods like `find`.

3. `.find(e => e.__vue_app__)`: Searches through the array of DOM elements to find the first element that has a `__vue_app__` property. This property is a reference to the Vue application instance that is associated with the DOM element where the Vue app is mounted.

4. `.__vue_app__`: Once the element with the Vue app instance is found, this property is accessed to retrieve the actual Vue app instance.

5. `.config.globalProperties.$store`: Accesses the global properties of the Vue app's configuration object. In Vue 3, global properties can be added to the app instance using `app.config.globalProperties`. If the application uses Vuex and the store has been injected as a global property (typically done in the main.js or main.ts file where the Vue app is created), it will be accessible here.

6. `.state`: Finally, this accesses the `state` object of the Vuex store.

So, when you run this code in the console of a browser that's displaying a Vue.js application with Vuex, it will return the current state of the Vuex store, allowing you to inspect it for debugging purposes.

Keep in mind that this is a somewhat hacky way to get to the Vuex store and relies on internal properties (`__vue_app__`) that are not part of the public API, meaning this approach could break in future versions of Vue. It's meant for debugging purposes only and should not be used in production code.

### Another approach using window

For a more reliable way to access the Vuex store in the console, you can assign the store to the window object when initializing your Vue app:

```javascript
// Inside your main.js or similar file
const app = createApp(App);
app.use(store);
app.mount('#app');

// Assign the store to the window object for easy access in the console
window.store = store;
```

Then, you can simply type `store.state` in the console to access the Vuex state.