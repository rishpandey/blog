---
extends: _layouts.post
section: content
title: "Let's build a service container in PHP"
cover_image: https://images.unsplash.com/photo-1554769944-3138b076c38a?q=80&w=3840&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D
date: 2024-08-1
featured: true
categories: [laravel, php]
---

In the world of modern PHP development, Service Containers (also known as Dependency Injection Containers) are really popular for managing class dependencies and promoting modular, testable code. Frameworks like Laravel and Symfony provide robust service containers out of the box. But most of the time developers have a hard time really understanding service containers.

Today we are building a simple yet functional service container from scratch in PHP. Hopefully by the end of this article you have a clear understanding of how it works and what it offers.

## What is a Service Container?

A **Service Container** is a tool for managing class dependencies and performing dependency injection. Think of it as a **central warehouse** where objects (services) are stored and delivered when needed.


For example we can imagine a restaurant kitchen. The chef (your code) needs ingredients (dependencies) to prepare a dish (functionality). Instead of the chef personally going to various stores (hardcoding dependencies), they request ingredients from the pantry (service container), which supplies everything needed.


### Why Use a Service Container?

- **Decoupling Dependencies**: Promotes loose coupling by injecting dependencies rather than hardcoding them.

  Instead of a chef only being able to cook with ingredients they personally bought, they can use any ingredients supplied by the pantry.

- **Easier Testing**: Simplifies mocking and testing by allowing dependencies to be swapped.

  You can replace real ingredients with cheaper alternatives (mock objects) to test the cooking process without wasting real food.

- **Centralized Configuration**: Provides a single place to manage object creation and configuration.

  The pantry keeps track of all ingredients, so the chef doesn't have to remember where everything is stored.


## Building our own Service Container

### Setting Up the Project

Before we start coding, ensure you have PHP 7.4 or higher installed. Create a new directory for our project:

```bash
mkdir php-service-container && cd php-service-container
```


### Designing the Container Interface

First, we'll define an interface that our container will implement. This ensures that our container adheres to a contract, making it interchangeable and testable.

```php
<?php
// ContainerInterface.php

interface ContainerInterface
{
    public function set(string $id, callable $concrete): void;

    public function get(string $id);

    public function has(string $id): bool;
}
```

- **set**: Registers a service with a factory (closure).
- **get**: Retrieves an instance of the service.
- **has**: Checks if a service is registered.

## Implementing the Service Container

Now, let's implement the `Container` class, which will manage our services and their dependencies.

```php
<?php
// Container.php

class Container implements ContainerInterface
{
    /**
     * Stores service bindings (factory functions).
     */
    private array $bindings = [];

    /**
     * Stores instantiated services.
     */
    private array $instances = [];

    /**
     * Registers a service with the container.
     *
     * @param string   $id       The unique identifier for the service.
     * @param callable $concrete A factory function that returns the service instance.
     */
    public function set(string $id, callable $concrete): void
    {
        $this->bindings[$id] = $concrete;
    }

    /**
     * Retrieves the service instance from the container.
     *
     * @param string $id The unique identifier for the service.
     * @return mixed     The service instance.
     */
    public function get(string $id)
    {
        if ($this->hasInstance($id)) {
            // Return the existing instance.
            return $this->instances[$id];
        }

        if ($this->hasBinding($id)) {
            // Create the instance using the factory function.
            $object = $this->bindings[$id]($this);
            $this->instances[$id] = $object;
            return $object;
        }

        // Attempt to auto-resolve the service.
        return $this->resolve($id);
    }

    /**
     * Checks if the service is registered in the container.
     */
    public function has(string $id): bool
    {
        return isset($this->instances[$id]) || isset($this->bindings[$id]);
    }

    /**
     * Checks if a service instance already exists.
     */
    private function hasInstance(string $id): bool
    {
        return isset($this->instances[$id]);
    }

    /**
     * Checks if a service is registered with a factory function.
     */
    private function hasBinding(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    /**
     * Resolves a service by creating an instance and resolving its dependencies.
     */
    private function resolve(string $class)
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} does not exist.");
        }
			
        // Uses PHP's Reflection API to inspect the class's properties and methods.
        $reflector = new ReflectionClass($class);

        // Checks that the class is not abstract or an interface.
        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$class} is not instantiable.");
        }
        
        // Get constuctor if exists
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            // No constructor, create an instance directly.
            return new $class;
        }

        // Get constructor parameters (dependencies).
        $parameters = $constructor->getParameters();

        // Resolve each dependency.
        $dependencies = $this->getDependencies($parameters);

        // Create a new instance with resolved dependencies.
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * Resolves the dependencies for the constructor parameters.
     */
    private function getDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                // Recursively resolve the dependency.
                $dependencies[] = $this->get($type->getName());
            } else {
                throw new Exception("Cannot resolve class dependency {$parameter->name}");
            }
        }

        return $dependencies;
    }
}
```

#### Explanation

- **Properties**

  - `$bindings`: Holds the mappings of service identifiers to their factory functions.
  - `$instances`: Holds the instantiated services.

- **Methods**

  - `set($id, $concrete)`: Registers a service with the container by storing its factory function.
  - `get($id)`: Retrieves the service instance. It checks if an instance already exists, or if a binding is available to create it. If neither, it attempts to auto-resolve the class.
  - `has($id)`: Checks if the service is registered or instantiated.
  - `resolve($class)`: Uses reflection to create an instance of the class, resolving its constructor dependencies.
  - `getDependencies($parameters)`: Resolves each constructor parameter by recursively calling `get()`.


This implementation allows the container to manage services and automatically resolve dependencies, promoting loose coupling in your applications. 

Our `Container` is like a smart pantry:

- **$bindings**: Recipes for creating ingredients (services).
- **$instances**: Already prepared ingredients ready for use.
- **set()**: Storing a recipe in the pantry.
- **get()**: Getting an ingredient; if it's not ready, we prepare it using the recipe.
- **resolve()**: If we don't have a recipe, we try to make the ingredient from scratch by looking at its "recipe book" (class constructor).

---

### Registering Services

We can now register services with our container.

```php
<?php

require 'ContainerInterface.php';
require 'Container.php';

// Example service class 
class Logger
{
    public function log(string $message)
    {
        echo "Log: {$message}\n";
    }
}

// Example service class 
class UserRepository
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function save(array $data)
    {
        // Save user data
        $this->logger->log('User saved.');
    }
}


// Set up container
$container = new Container();

// Register Logger service
$container->set(Logger::class, function ($c) {
    return new Logger();
});

// Register UserRepository service
$container->set(UserRepository::class, function ($c) {
    return new UserRepository($c->get(Logger::class));
});

// Retrieve an instance
$userRepo = $container->get(UserRepository::class);
$userRepo->save(['name' => 'John Doe']);
```

### Resolving Dependencies

Our container can resolve dependencies automatically. When `get` is called, it attempts to:

1. Return an existing instance.

2. Create a new instance using a registered factory.

3. Auto-resolve the class and its dependencies via reflection.

### Handling Constructor Injection

The `resolve` method uses reflection to inspect the constructor parameters of the requested class. It recursively resolves each dependency.

```php
private function resolve(string $class)
{
    // ...
    $constructor = $reflector->getConstructor();

    if (is_null($constructor)) {
        return new $class;
    }

    $parameters = $constructor->getParameters();
    $dependencies = $this->getDependencies($parameters);

    return $reflector->newInstanceArgs($dependencies);
}
```

The `getDependencies` method handles each parameter:

- If the parameter has a class type hint, it resolves that class.
- If it cannot resolve a parameter, it throws an exception.


Now that we have our own basic Service Container. How do we expand it? Because our custom container shares foundational concepts with Laravel's service container, we can take a look at what Laravel offers to make our Service Container even more powerful.

### Watch out Laravel, here we come!

To align our container more closely with Laravel's, let's implement interface binding and singletons.

### Implementing Interface Binding

First, modify the `set` method to accept an optional interface.

```php
public function set(string $id, callable $concrete, string $alias = null): void
{
    $this->bindings[$id] = $concrete;

    if ($alias) {
        $this->aliases[$alias] = $id;
    }
}

public function get(string $id)
{
    if (isset($this->aliases[$id])) {
        $id = $this->aliases[$id];
    }

    // ... rest of the method
}
```

### Implementing Singletons

Add a `singleton` method.

```php
public function singleton(string $id, callable $concrete): void
{
    $this->set($id, function ($c) use ($concrete) {
        static $object;
        if (!$object) {
            $object = $concrete($c);
        }
        return $object;
    });
}
```

### Testing Our Container

Let's test automatic resolution by not registering the `Logger` class explicitly.

```php
// Remove Logger registration
// $container->set(Logger::class, function ($c) {
//     return new Logger();
// });

// Update UserRepository registration to use interface binding
interface LoggerInterface
{
    public function log(string $message);
}

class Logger implements LoggerInterface
{
    public function log(string $message)
    {
        echo "Log: {$message}\n";
    }
}

// Bind interface to implementation
$container->set(LoggerInterface::class, function ($c) {
    return new Logger();
});

// Update UserRepository to depend on LoggerInterface
class UserRepository
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // ... rest of the class
}
```

Now, when we request `UserRepository`, the container injects `Logger` wherever `LoggerInterface` is required.

---

We've built a simple yet powerful service container that can register services, resolve dependencies, and promote loose coupling in our applications. By adding features like interface binding and singletons, we've brought our container closer to Laravel's.

#### What's left?

- **Facade Support**: Laravel uses facades to provide a static interface to classes in the container. 

- **Event System**: Laravel's container integrates with an event system for more dynamic binding.

- **Service Providers**: Laravel uses service providers to register bindings, allowing for modular organization.

- **Parameter Injection**: Support injecting primitive parameters (e.g., configuration values).

- **Method Injection**: Allow injection directly into methods, not just constructors.

- **Contextual Binding**: Provide different implementations based on where the dependency is injected.


Understanding the inner workings of a service container enhances our ability to design better software architectures. While our container is rudimentary compared to Laravel's, it serves as a solid foundation for grasping the concepts of dependency injection and service management in PHP. 
