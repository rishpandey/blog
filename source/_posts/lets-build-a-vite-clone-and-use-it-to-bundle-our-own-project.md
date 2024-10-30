---
extends: _layouts.post
section: content
title: "Let's make a Vite clone and use it to build our own project"
date: 2024-09-01
featured: true
categories: [vue, js]
---

Modern web development requires fast and efficient tooling to enhance developer experience and productivity. **Vite** is a build tool that has gained popularity for its lightning-fast development server and seamless build process. Let's dive deep into how to create a minimal clone of Vite, package it as an NPM module, and install it in a project.


### What is Vite?

[Vite](https://vitejs.dev/) (pronounced "veet", French for "quick") is a modern frontend build tool that offers a fast development experience. Created by Evan You, the author of Vue.js, Vite leverages native ES modules in the browser and provides an optimized build process using Rollup.

**Key Features of Vite:**

- Instant server start, regardless of application size.
- Lightning-fast Hot Module Replacement (HMR).
- Efficient production builds with code splitting.

## Building a Minimal Vite Clone

Let's build a simplified version of Vite to understand its inner workings. We'll then package it as an NPM module.

### 1. Project Setup

Create a new directory for your Vite clone:

```bash
mkdir mini-vite
cd mini-vite
npm init -y
```

Install the necessary dependencies:

```bash
npm install express ws esbuild chokidar
```

- **express**: For creating the HTTP server.
- **ws**: WebSocket library for HMR.
- **esbuild**: For transforming and bundling code.
- **chokidar**: For watching file changes.

### 2. Creating the Development Server

Create an `index.js` file:

```javascript
// index.js
const express = require('express');
const path = require('path');

function createServer(root = process.cwd(), isProduction = false) {
  const app = express();

  // Middleware to handle module resolution
  app.use(async (req, res, next) => {
    if (req.path.endsWith('.js')) {
      // Handle JavaScript files
      // Implementation will be added later
    } else {
      next();
    }
  });

  // Serve static files
  app.use(express.static(root));

  return { app };
}

module.exports = { createServer };
```

By building a custom development server, we can serve our application files over HTTP, handle native ES module imports, and implement crucial features like Hot Module Replacement (HMR). This server acts as the backbone of our tool, allowing us to process and deliver application files dynamically, rewrite import paths for proper module resolution, and enhance the development workflow to mirror the fast and efficient experience that Vite provides.

### 3. Implementing ES Module Resolution

We need to handle module imports by rewriting the import paths.

**1. Middleware for Transforming and Serving Modules**

Update the middleware in `index.js`:

```javascript
const fs = require('fs').promises;
const esbuild = require('esbuild');

app.use(async (req, res, next) => {
  if (req.path.endsWith('.js')) {
    const url = path.join(root, req.path);
    let content = await fs.readFile(url, 'utf8');

    // Transform code using esbuild
    const result = await esbuild.transform(content, {
      loader: 'js',
      sourcemap: true,
      target: 'es2015',
    });

    // Rewrite import paths
    result.code = result.code.replace(/from\s+['"](.*)\.js['"]/g, (match, p1) => {
      return `from '${p1}'`;
    });

    res.setHeader('Content-Type', 'application/javascript');
    res.send(result.code);
  } else {
    next();
  }
});
```

### 4. Adding Hot Module Replacement

Implement HMR using WebSockets.

**1. Set Up WebSocket Server**

Add the following after `app.use(express.static(root));`:

```javascript
const WebSocket = require('ws');
const chokidar = require('chokidar');

const wss = new WebSocket.Server({ noServer: true });
const sockets = new Set();

app.on('upgrade', (request, socket, head) => {
  if (request.url === '/ws') {
    wss.handleUpgrade(request, socket, head, (ws) => {
      sockets.add(ws);
      ws.on('close', () => sockets.delete(ws));
    });
  } else {
    socket.destroy();
  }
});

chokidar.watch(root).on('change', (file) => {
  console.log(`File changed: ${file}`);
  for (const ws of sockets) {
    ws.send(JSON.stringify({ type: 'reload' }));
  }
});
```

- **WebSocket Server**: Handles HMR connections.

- **chokidar**: Watches for file changes and notifies connected clients.


**2. Modify Client Code to Support HMR**

Clients need to connect to the WebSocket server. We will tackle this later.

## Packaging the Vite Clone as an NPM Module

Now that we've built our minimal Vite clone, we'll package it as an NPM module so it can be installed in other projects.

### 1. Preparing the Package

Update your `package.json` to include necessary fields:

```json
{
  "name": "mini-vite",
  "version": "1.0.0",
  "main": "index.js",
  "bin": {
    "mini-vite": "./bin/mini-vite.js"
  },
  "dependencies": {
    "chokidar": "^3.5.3",
    "esbuild": "^0.15.12",
    "express": "^4.18.1",
    "ws": "^8.8.1"
  }
}
```

- **name**: The package name.

- **version**: Package version.

- **main**: Entry point of the module.

- **bin**: Specifies the executable command.

### 2. Creating the CLI Script

Create a `bin` directory and add `mini-vite.js`:

```bash
mkdir bin
touch bin/mini-vite.js
chmod +x bin/mini-vite.js
```

**bin/mini-vite.js**

```javascript
#!/usr/bin/env node

const { createServer } = require('../index.js');

const { app } = createServer();

const port = 3000;

app.listen(port, () => {
  console.log(`Dev server running at http://localhost:${port}`);
});
```

- The script sets up and starts the development server.

- `#!/usr/bin/env node` makes the script executable.

### 3. Testing Locally with `npm link`

Before publishing to NPM, you can test the package locally.

1. In the `mini-vite` directory, run:

   ```bash
   npm link
   ```

2. In your project directory (we'll create one shortly), run:

   ```bash
   npm link mini-vite
   ```

This makes `mini-vite` available as a command in your project.

### 4. Publishing to NPM Registry

**Note**: Publishing to NPM requires an NPM account.

1. Log in to NPM:

   ```bash
   npm login
   ```

2. Publish the package:

   ```bash
   npm publish
   ```

**Important**: Ensure the package name is unique on NPM. If `mini-vite` is taken, choose a different name.

---

## Using the Vite Clone in a Project

Now, let's create a project and use our `mini-vite` package.

### 1. Installing the Package

If you published to NPM:

```bash
npm install mini-vite --save-dev
```

If you're testing locally with `npm link`:

```bash
npm link mini-vite
```

### 2. Project Structure

Create a new project directory:

```bash
mkdir my-app
cd my-app
npm init -y
```

Install the package:

```bash
npm install mini-vite --save-dev
```

Create the following directory structure:

```
my-app/
├── index.html
├── main.js
├── components/
│   └── hello.js
```

**index.html**

```html
<!DOCTYPE html>
<html>
<head>
  <title>My App with Mini Vite</title>
  <script type="module" src="/main.js"></script>
</head>
<body>
  <div id="app"></div>
  <script type="module">
    const socket = new WebSocket(`ws://${location.host}/ws`);
    socket.onmessage = (event) => {
      const data = JSON.parse(event.data);
      if (data.type === 'reload') {
        window.location.reload();
      }
    };
  </script>
</body>
</html>
```

**main.js**

```javascript
import { sayHello } from './components/hello.js';

document.getElementById('app').innerHTML = `<h2>${sayHello('World')}</h2>`;
```

**components/hello.js**

```javascript
export function sayHello(name) {
  return `Hello, ${name}!`;
}
```

### 3. Development Workflow

Add a script to your `package.json`:

```json
{
  "scripts": {
    "dev": "mini-vite"
  }
}
```

Start the development server:

```bash
npm run dev
```

Access the application at `http://localhost:3000`.

**HMR in Action:**

- Edit `components/hello.js`:

  ```javascript
  export function sayHello(name) {
    return `Hi, ${name}! Welcome to Mini Vite.`;
  }
  ```

- Save the file.
- The browser should reload automatically, reflecting the changes.

We've built a minimal clone of Vite, packaged it as an NPM module, and demonstrated how to install and use it in a project. This exercise provides insight into how modern build tools like Vite function and how you can create and distribute your own development tools.

## Further Enhancements

To expand on this minimal implementation, consider adding:

- **Production Build Command**: Implement a build command using `esbuild` to bundle the application.

- **Plugin System**: Create a plugin architecture to extend functionality.

- **CSS Handling**: Add support for importing and hot-reloading CSS modules.

- **TypeScript Support**: Enhance the build process to handle TypeScript files.

- **Dependency Pre-Bundling**: Pre-bundle dependencies for faster module resolution.

---

By understanding and implementing the key features of Vite, we gain deeper insight into modern web development practices and tooling. Building and packaging your own tools not only enhances your skills but also contributes to the open-source community.
