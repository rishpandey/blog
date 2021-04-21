---
extends: _layouts.post
section: content
title: "Getting Started with Web Development: Intro to PHP"
date: 2021-04-05
categories: [basics]
---

## Programming Basics

Programming is the art of instructing computer to perform simple and complex tasks. A program is a set of instructions which are executed by the computer.

Computers only understand one language that is binary, 0 and 1, on and off. Everything you need the computer to understand or do, needs to be instructed through these 0s and 1s. 

So, every source code needs to be translated into binary code so the computed can understand it. These translators can be:
 - Interpreters
 - Compilers
 - Hybrid
 - Assembler

Every programming language has some sort of translator. What a programming language does is that it allow you to write code which is understandable by people (after some learning) but can also be translated to a binary. 

There are some things which are found in most programming languages. You can think of these as a basic set of features, we can use to write programs.

- Keywords 
- Identifiers
- Literals
- Variables
- Constants
- Primitive data types
- Complex data types
- Operators
- Comments
- Conditional Branching
- Iteration
- Errors and exceptions


## PHP language

### What is PHP and how it works?

PHP is a flexible, dynamic language that supports a variety of programming techniques. PHP has gone through many changes and rewrites and evolved dramatically over the years.

PHP is a popular general-purpose scripting language that is especially suited to web development.

Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.

PHP works with the a web server like apache or nginx. When we type a URL into your web browser’s address bar, you’re sending a message to the web server at that URL, asking it to send you an HTML file. The web server responds by sending the requested file. Your browser reads the HTML file and displays the web page.

When PHP is installed, the web server is configured to expect certain file extensions like .php to contain PHP language statements. 

When the web server gets a request for a file with the designated extension, it sends the HTML statements as is, but PHP statements are processed by the PHP software before they’re sent to the requester. When PHP language statements are processed, only the output is sent to the web browser. The PHP code is not normally seen by the user.


### Setting up PHP

To start working with PHP we need bunch of things:

- PHP - the programming language
- Apache2  - the web server

This one is not a requirement for PHP but almost every PHP project needs a database to persist data.
- Mysql - a database management system 

To set up all of these is time taking and kinda hard. We can use something like XAMPP or WAMP to save ourselves a lot of time and hassle. XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl. The XAMPP open source package has been set up to be incredibly easy to install and to use. 

So, XAMPP is a software which we can install that will setup the whole environment for us. 

You can install XAMPP from their main [website](https://www.apachefriends.org/index.html).


## Syntax and Basics

There are many ways you can work with PHP. We will start off with the most basic one that is embedding PHP code in the HTML. 

**PHP Tags**

To embed php code in HTML we need to tell the server what part of the code is PHP and should be executed and attached to the rest of the documented. 

```

<!DOCTYPE html>
<html>
<body>
    <h1>Welcome to <?php echo $site; ?></h1>
</body>
</html>

```

There are many types of tags in PHP. 
- `<?php …. ?>`  - XML style tag, the only one you will use.
- `<? ... ?>` - Short style tag, not recommended.
- `<% … %>`  - ASP style tag, not recommended.


**PHP Statements**

Everything we need the php interpreter to execute is inserted between the php tags, above example had one php statement, 
`echo $site;` which will echo or print the value of variable $site.

**Whitespace**

Spacing characters such as newlines (carriage returns), spaces, and tabs are known as whitespace.As you should already know, browsers ignore whitespace in HTML. So does the PHP engine.

```

echo 'one'; echo 'punch';     echo 'man';

// same as 

echo 'one';
echo 'punch';
echo 'man';
```

**Comments**

We spend around 10x more time reading the code vs the time spent on writing it.  Comments act as notes to the person reading the code. Comments can be used to explain the purpose of the script and why it was written the way it was, when it was last modified, and so on.

The comments are ignored by the PHP parser (interpreter) and have no effect on performance.

```

// this is a single line comment


/*
	A multiline comment...
	looks like this
*/

```


**Variables**

A php variable starts with ‘$’ and you must put it before every variable as long as it is not a constant.

When creating PHP variables, there are four rules to follow: 
- Variable names must start with a letter of the alphabet or the _ (underscore) character. 
- Variable names can contain only the characters a-z, A-Z, 0-9, and _ (underscore). 
- Variable names may not contain spaces. If a variable must comprise more than one word, the words should be separated with the _ (underscore) character (e.g., $user_name) or use camelCase notation (e.g. $userName)
- Variable names are case-sensitive.


NOTE: 
You must have noticed that we are using semicolons after every php statement. A semicolon in PHP is necessary and it denotes that a php expression is finished.


Types of Variables:
- String - sequence of characters like ‘yo yo’
- Numeric - integers and doubles (decimal numbers) 
- Boolean - true and false
- Arrays - named and indexed collections of values.
- Object - instances of classes, more about this later.



**Constants**

Constants are very similar to variables, the only difference is that we can’t change their values once it’s assigned. Constants don’t start with ‘$’.

`define(“FTP_URL”, “68.11.123.100“);`


**Operators**

There are many types of operators supported in PHP 
- Arithmetic Operators
These are the operators used to perform arithmetic operations on variables. 
We have addition, subtraction, multiplication, division, modulus, increment and decrement in PHP.

- Assignment Operator
These are used to assign values to variables. In PHP, we have
	- equals (=)
	- plus-equals (+=)
	- minus-equals (-=)
	- multiply-equals (*=)
	- divide-equals (/=) 
	- concat-equals (.=)
	- mod-equals (%=)

- Comparison Operator
These are mostly seen inside an if-else block or a loop. These operators are used to construct a condition by comparing two variables or values. PHP supports following comparison operators,
	- == Is equal to
	- != Is not equal to
	- > Is greater than
	- < Is less than
	- >= Is greater than or equal to 
	- <= Is less than or equal to 

PHP is a loosely types language. For example, you can create a multiple-digit number and extract the nth digit from it, simply by assuming it to be a string. 

```

<?php $number = 121 * 133131; 
echo substr($number, 3, 1); 
?> 

```

In the above example, $number is clearly a number but it is automatically converted to a string to accommodate substr(), such behavior is not possible in many other programming languages. 

This means, that we don’t have to worry a lot about the variable types too much in PHP. Is it a good thing? Most experts will disagree. But this reduces the learning curves and makes it very easy for beginners to get started.


**Functions**

Functions are used to separate out sections of code that perform a particular task. A function should ideally perform a single action and do it well.

```

function mergeStringsWithSpaces($str1, $str2){
	return $str1 . ' ' . $str2;
}

// how to call
$newString = mergeStringsWithSpaces('Hey', 'you'); 

echo $newString; // 'Hey you'

```

In the above example $str1 and $str2 are function parameters. 


**Variable Scope**

Variable scope refers to the context where a specific variable is accessible. In PHP, we have the following scopes,

- Local Variable
These are related to a function. If a variable is created within or passed as an argument to a function, then it can only be accessed inside a function. Such variables are called Local variables.

- Global Variable
There are times when we need to declare a variable globally and make it available to the whole codebase. Global variables can be created by using the global keyword.

- Static Variable 
A local variable is destroyed on the function’s exit. There are specific use cases where we may need to keep a local variable shared between function calls, static variables can do that. A static variable will not lose its value when the function exits and will still hold that value should the function be called again. Static variables can be created by using the static keyword.

- Superglobal Variables
These variables are provided by PHP environment and are accessible from everywhere.

	- $GLOBALS - An array of all super global variables.
	- $_SERVER - Information such as headers, paths, and script locations.
	- $_GET - Variables passed to the current script via the HTTP GET method.
	- $_POST - Variables passed to the current script via the HTTP POST method.
	- $_FILES - Variable used to access and store uploaded files 
	- $_COOKIE - Variables passed to the current script via the HTTP cookies.
	- $_SESSION - Current session variable in PHP
	- $_REQUEST - Information passed by the browser
	- $_ENV - Variables passed to the current script via the environment method, you can set the env variables in php or .htaccess.


**Conditional Flow**

Conditionals are used to change the program flow, they allow us to perform actions based on a condition. 

- If/else Statement

```

if($age > 18) {
	// show login information
	$ableToLogin = true;
} else if($age > 0) {
	$ableToLogin = false;
	echo 'You have to be older than 18 to login.';
} else {
	echo 'What's up time traveller?';
}

```

- Switch Statement

A switch statement is used when we have a number of different conditions like a variable has a value that would execute different code.

```

switch ($occupation) { 
	case "Doctor":
		echo 'Welcome doctor, patients are waiting';
		break; 
	case "Engineer":
		echo 'Welcome engineer, construction is halted';
		break;
	case "Programmer":
		echo 'Welcome programmer, do whatever you do nerd.';
		break;
	default:
		echo 'We don't know that occupation'l
		break;
} 

```

Break keyword is used to break out of the current code block. Default action is used when no other case values are satisfied.

- Inline if/else or Ternary operation

Sometimes we need to use the if/else block to perform a very simple action like setting a variable or printing a message. We can do that inline using ternary operator.

```

if($age > 18){
	$message = 'Allowed'
} else {
	$message = 'Not Allowed'
}

echo $message 

// using ternary operator
// This is same as above.

$message = $age > 18 ? 'Allowed' : 'Not Allowed';
echo $message;

```



**Loops**

Loop is a sequence of instructions that is continually repeated until a certain condition is reached. In PHP we have,

- While loop

The condition is checked, if the condition is true then the loop is executed, and repeat.

```

<?php 	$fuel = 50; 
	while ($fuel > 1) { 
		// Keep driving
		echo "We still have fuel"; 
	}
?> 


```

- Do while loop

There is slight difference here, first the loop is executed, then the condition is checked. If the condition is true, then repeat. 
Avoid this loop.

```

<?php 	$fuel = 50; 
	do { 
		// Keep driving
		echo "We still have fuel"; 
	} while ($fuel > 2);
?> 


```


- For loop
This is the most used loop as this has the ability to set up counter variable, check condition and increment/decrement the counter in one line.

```
<?php 
	for ($fuel = 50; $fuel > 1 ; $fuel--) { 
		// Keep driving 
		echo "We still have fuel"; 
	} 

?> 


```

- Foreach loop
The foreach loop allow us to iterate over arrays, it works only on arrays and objects.

```

$myArray = array(1, 2, 3, 4);

foreach ($myArray as $element) {
	echo $element;
}

```


We can use the ‘break’ keyword to break out of the current loop just like the switch block. We can also use ‘continue’ to move to the next iteration of the loop without executing the remaining code in the loop.


**Type Casting**

PHP automatically converts the values from one type to another whenever needed, that’s called implicit casting. To manually cast a variable to another type we can use manual casting.

- (int) $var - Cast to an integer, remove decimals
- (bool) $var - Cast to boolean 
- (float) / (double) / (real) $var - Cast to decimal number
- (string) $var - Cast to string
- (array) $var - Cast to array - creates an array with first element $var
- (object) $var - Cast to object 


**PHP Arrays**

Array is a collection of data. In PHP, we can create an array of any type of data and mix multiple datatypes.

```
$people = ['Holt', 'Yousuf', 'Jim'];
$people = array('Holt', 'Yousuf', 'Jim'); // same as above

// accessing 
echo $people[0]; // Holt

// push to array
$people[] = 'Joe';

```

Associative Array
Normal arrays have numeric indices starting from 0, we can name our own indices as we want in PHP. 

```

$messages = [
	'error' => 'There was an error',
	'success' => 'This was a great success',
	'pass' => 'You just passed'
];

echo $message['pass'];

$message['submit'] = 'Thanks for submitting, wait for results';

```

Multidimensional Array
We can also have arrays inside an array and use this functionality to create array with more than one dimension like a matrix (2D).

```

$vehicle = array(
	'car' => array(
		'ford' => 'GT',
		'honda' => 'Prius',
	),
	'bike' => array(
		'yamaha' => 'ZZR',
		'tvs' => 'Apache'
	),
	'misc' => array(
		'horse' => '1 HP',
		'toy' => array(
			'car' => 'Roadmaster GI'
		)
	),
)

// access 
echo $vehicle['car']['honda'];
echo $vehicle['misc']['toy']['car'];
```


Array Functions
- is_array - Check if a variable is array.
- count - Get the count of all elements in array
- sort/rsort - Used to sort an array, accepts second argument `SORT_NUMERIC or SORT_STRING`. 
- explode - converts a string to array
- implode - converts an array to string
- compact - converts a variable to key/value pair in array
- extract - converts an array key/value pair to variable
- 


**Including PHP Files**

To keep our PHP code manageable, we should keep our files lean and keep relevant code together in one file. We may have a bunch of function which can be reused in other projects, it makes sense to create another file which can act as a function library and include it in the current codebase.

- include statement
This method will act like you copy and pasted the entire file on the location where the include is called.

- include_once 
To make sure that the file is only include once we use `include_once`. Let’s say we have two libraries which include each other, if we add these libraries using include it will lead to each library being included twice. We should use `include_once` in most places.

```

include_once "lib1.php";
include_once "lib2.php";

// run methods from lib1 and lib2

```

- require and require_once
If we use include and the file is not found the program will continue as usual. When it is absolutely essential to include a file, we should require it. If a file is not found in the case of require the program halts.


## Object Oriented PHP
* Class − This is a programmer-defined data type, which includes local functions as well as local data. You can think of a class as a template for making many instances of the same kind (or class) of object, a blueprint for an object.

* Object − An instance of the data structure defined by a class. We define a class once and then make many objects that belong to it. So if we have a Car class, we can have a bunch of different car objects with individual parameters.   

* Inheritance − If we want to have an ‘is-a’ relationship between two classes, we use inheritance, let’s say we have a ‘Car’ class and a ‘FordCar’ class, here is the FordCar is also a Car and called as a child class. A child class will inherit all or few member functions and variables of a parent class.

* Polymorphism − An object oriented concept where same function can be used for different purposes. 

* Data Abstraction − Any representation of data in which the implementation details are hidden (abstracted). We can achieve this using encapsulation in OOP which refers to a concept where we encapsulate all the data and member functions together to form an object.

* Constructor − refers to a special type of function which will be called automatically whenever there is an object formation from a class.

* Destructor − refers to a special type of function which will be called automatically whenever an object is deleted or goes out of scope.

**Class**
To create new objects we need a class. A class can have any number of variables (we call them properties) and functions (known as methods).

```

class Car {

	public $model;
	public $mileage;

	function drive()
	{
		echo 'driving a generic car';
	}

}

```

**Object**

To create an object or instance of a class we use the new keyword.

```

$car1 = new Car();
$car2 = new Car();

```

- We can access a class’s property or call a method using the arrow operator `->`. 


**Constructor**
The constructor is a method which is automatically added to the class when we declare it, when we create a new object the constructor is called. We can change the behavior of the default constructor using our own constructor.

```

class Car {

	public $model;
	public $mileage;

	function __construct($modelName, $mileage) 
	{
		$this->model = $modelName;
		$this->mileage = $mileage;
	}	

	function drive() 
	{
		echo 'driving a generic car';
	}

}


```


$this is a very important variable in PHP, $this is assigned to the current instance of the class. $this allows us to access the object state from the methods.

**Static Methods**
Static methods are related to class not the object. This means we can call a static method without instantiation a class.


```

class Car {

	...

	static function enquiryMessage()
	{
		return "For more information, call us at 000-000";
	}
	
}

// We can call the method using

Car::enquiryMessage();

```

The double colon here is called the scope resolution operator. Static functions are useful for performing actions relating to the class itself, but not to specific instances of the class.

**Variables and Constants in OOP**
We can access the variables using `->` and add constant variables using const keyword. Constant variables can be accessed in a static context.

```

class Car {

	public $model;
	const $brand = 'Ford';

	function __construct($modelName) 
	{
		$this->model = $modelName;
	}	

}

// accessing vars

$car = new Car('Figo');

echo $car->model; // Figo
echo Car::model; // Ford

// This works but not recommended
echo $car::brand; // Ford
``` 


**Scope in PHP Classes**

There are three scopes for all variables and method in PHP classes.

- public
These properties are the default when declaring a variable or method. These are accessible using the arrow operator on the object. 

Should be used on methods and where outside code should access this member.

- protected
These properties and methods can be referenced only by the object’s class methods and those of any child classes (inheritance). 

Should be used on variables and properties where we don’t want them to be accessed from outside (using arrow) and still want to allow inheritance.

- private 
These members can be referenced only by methods within the same classes and not even by the child classes.

Should be used for properties which we do not wish to pass to child classes.

**Inheritance**

We can use inheritance to derive subclasses from a class. This can help save time writing unnecessary code. Inheritance creates an is-a relationship between parent and child classes.

```

class Car {

	protected $model;

	function __construct($modelName) 
	{
		$this->model = $modelName;
	}	

	function drive()
	{
		return 'Drives a generic car.';
	}

}

class FordCar extends Car {

	function drive()
	{
		return 'Drives a Ford.';
	}

}

```


When you extend a class, if you declare your own constructor PHP will not automatically call the constructor method of the parent class, so a subclass should always call the parent constructors.

To access the property or call a method of a parent class we can do something like, `parent::__contruct()` here we are calling the parent’s constructor.

**Encapsulation**

We can use encapsulation to create has-a relationship between objects. 

```
// singleton pattern
class App {
     private static $user;

     public function User( ) {
          if( $this->user == null ) {
               $this->user = new User();
          }
          return $this->user;
     }

}

class User {
     private $name;

     public function __construct() {
          $this->name = "Rish";
     }

     public function getName() {
          return $this->_name;
     }
}

$app = new App();

echo $app->User()->getName();


```


### Date and Time 
PHP uses standard UNIX timestamps to manage date/time. This timestamp is the number of seconds elapsed since midnight Jan 1, 1970. 

```

echo time(); 
// returns the number of seconds it has been since Midnight Jan 1 1970 

```

Date method
To display a date, we use the date function. This function supports a lot of formatting options, that allow us to show the date exactly like we want.

```

date($format, $timestamp);

``` 

**Date Formats**
Day specifiers
	- d  - Day of month, two digits, with leading zeros -  01 to 31 
	- D - Day of week, three letters  - Mon to Sun 
	- j - Day of month, no leading zeros - 1 to 31 
	- l - Day of week, full names  - Sunday to Saturday 
	- N - Day of week, numeric, Monday to Sunday -1 to 7 
	- S - Suffix for day of month (useful with specifier j) - st, nd, rd, or th 
	- w - Day of week, numeric, Sunday to Saturday - 0 to 6 
	- z - Day of year - 0 to 365 

Week specifier 
	- W - Week number of year - 01 to 52 

Month specifiers 
	- F - Month name - January to December 
	- m - Month number with leading zeros - 01 to 12 
	- M - Month name, three letters - Jan to Dec 
	- n - Month number, no leading zeros - 1 to 12 
	- t - Number of days in given month - 28, 29, 30, or 31 

Year specifiers 
	- L - Leap year - 1 = Yes, 0 = No 
	- Y - Year, four digits - 0000 to 9999 
	- y - Year, two digits - 00 to 99 

Time specifiers 
	- a - Before or after midday, lowercase - am or pm 
	- A - Before or after midday, uppercase - AM or PM 
	- g - Hour of day, 12-hour format, no leading zeros - 1 to 12 
	- G - Hour of day, 24-hour format, no leading zeros - 1 to 24 
	- h - Hour of day, 12-hour format, with leading zeros - 01 to 12 
	- H - Hour of day, 24-hour format, with leading zeros - 01 to 24 
	- I - Minutes, with leading zeros - 00 to 59 
	- s - Seconds, with leading zeros - 00 to 59

```

echo date("l F jS, Y - g:i a", time());

// Tuesday June 2nd, 2020 - 11:21 am
// DayOfTheWeek MonthName Date+Suffix - Hour:Minute (am/pm)
```


### Exception Handling 

Exceptions provide control over runtime error handling.

- Try
A try block contains the part of code that can cause an exception. If a exception is triggered it’s thrown, if not then the normal flow is continued.
 
- Catch
A catch block is used to cater to the situation when the exception occurred. If an exception is thrown it’s caught by the catch block.

- Throw
This keyword is used to signal that an exception has occurred, must have a catch block associated to this.

```
// create custom exception
class DivideByZeroException extends Exception {};

function divideNumbers($numerator, $denominator)
{
    try {
        if ($denominator == 0) {
            throw new DivideByZeroException();
        } else {
        		return $numerator / $denominator;
        }
    }
    catch (DivideByZeroException $ex) {
        echo "You tried to divide by zero.";
    }
    catch (Exception $x) {
        echo "Unknown exception has occured.";
    }
}

```

## Concepts, Algorithms and Data Structures
In this section we will improve our core programming skills and do an introduction of very basic algorithms and Data Structures.

**Stack**

A stack is a pile of objects arranged in layers. For example a stack of trays in the school cafeteria. 

In computer science, a stack is a sequential collection with a particular property, in that, the last object placed on the stack, will be the first object removed, referred to as last in first out, or LIFO. 

The basic operations which define a stack are:
* init – create the stack.
* push – add an item to the top of the stack.
* pop – remove the last item added to the top of the stack.
* top – look at the item on the top of the stack without removing it.
* isEmpty – return whether the stack contains no more items..

```

<?php
class BucketList
{
    protected $stack;
    protected $limit;
    
    public function __construct($limit = 100) 
	  {
        // initialize the stack
        $this->stack = array();

        // stack can only contain this many items
        $this->limit = $limit;
    }

    public function push($item) 
    {
        // check if stack limit is reached
        if (count($this->stack) < $this->limit) {
			  // add item to array start
            array_unshift($this->stack, $item);
        } else {
            throw new Exception('Stack is full!'); 
        }
    }

    public function pop() {
        if ($this->isEmpty()) {
		      throw new Exception('Stack is empty!');
		  } else {
            // take item from the start of the array
            return array_shift($this->stack);
        }
    }

    public function top() {
        return current($this->stack);
    }

    public function isEmpty() {
        return empty($this->stack);
    }
}


```


**Queue**

A queue is another abstract data type, which operates on a first in first out basis, or FIFO exactly like a real life queue where a new person starts at the end of the line.

The basic operations which define a queue are:
* init – create the queue.
* enqueue – add an item to the end or tail of the queue.
* dequeue – remove an item from the front or head of the queue.
* isEmpty – return whether the queue contains no more items.


```

<?php
class BucketList
{
    protected $queue;
    protected $limit;
    
    public function __construct($limit = 100) 
	  {
        // initialize the stack
        $this->queue = array();

        // stack can only contain this many items
        $this->limit = $limit;
    }

    public function enqueue($item) 
    {
        // check if stack limit is reached
        if (count($this->queue) < $this->limit) {
			  // add item to array end
            array_push($this->queue, $item);
        } else {
            throw new Exception('Queue is at capacity!'); 
        }
    }

    public function dequeue() {
        if ($this->isEmpty()) {
		      throw new Exception('Queue is empty!');
		  } else {
            // take item from the start of the array
            return array_shift($this->queue);
        }
    }

    public function isEmpty() {
        return empty($this->queue);
    }
}


```


**Recursion**

A recursive function is one that calls itself, either directly or in a cycle of function calls. It is a method of problem solving where we first solve a smaller version of the problem and then use that result to formulate an answer to the original problem.

To write a recursive function, we need to provide it with a guard clause. A guard clause is usually an if condition which halts the recursion. If such a condition is not given, the function will keep calling itself forever like an infinite loop until the memory is exhausted.

```
<?php
function doSomethingRecursive (args) {
    if (guard case) {
		  // stop recursion when this condition is met
        return simple value;
    }
    else {
		   // manipulate args to get simpler args
        // call function again with simpler args
        doSomethingRecursive(argsSimplified);
    }
}
```

**Factorial**

The simplest example of recursion is the algorithm to calculate the factorial of a number.

```
<?php
function getFactorial($number) {
    if ($number < 0) {
        throw new InvalidArgumentException('Number cannot be less than zero');
    }
    if ($number == 0) {
        return 1;
    }
    return $number * getFactorial($number – 1);
}


```

**Prime Number**

```

function checkIfPrimeSlow($number)
{ 
    if ($number == 1) 
    return 0; 
    for ($i = 2; $i <= $number/2; $i++){ 
        if ($number % $i == 0) 
            return false; 
    } 
    return true; 
} 
  
```

We need to optimize this. If you think about it, a larger factor of n must be a multiple of smaller factor. 

So we only need to check smaller factors to be to find out if this is a prime number. Smaller factors will be less than factors which are equal, the square root of the number.  

```
function primeCheck($number)
{ 
    if ($number == 1) 
    return 0; 
      
    for ($i = 2; $i <= sqrt($number); $i++){ 
        if ($number % $i == 0) 
            return 0; 
    } 
    return 1; 
} 

```


**Sorting**

Bubble Sort
This works by running through the array and swapping a value for the next value along if that value is less than the current value. After the first run, the highest value in the array will be at the correct end. Then this process is repeated for every element.


```

function bubbleSort($array) {
	// array is empty
	if (!$length = count($array)) {
		return $array;
	}
	
	// run through each element of the array
	for ($outer = 0; $outer < $length; $outer++) {

		// compare each element with all others 		for ($inner = 0; $inner < $length; $inner++) { 			
			// replace if the current one is smaller
			if ($array[$outer] < $array[$inner]) { 				$tmp = $array[$outer]; 				$array[$outer] = $array[$inner]; 				$array[$inner] = $tmp;
			}

		}
	}
} 


```

This is the worst sorting algorithm, as it is most inefficient.


Quick Sort
The works by splitting the array into smaller and smaller pieces eventually merging the array back together again at the end. It first finds a middle point and then splits the array depending on if the current value is higher or lower than the middle value. It then recursively calls itself in order to do the same to each section of the array.

```

function quickSort($array) {	
	// array is empty
	if (!$length = count($array)) {
		return $array;
	} 	
	// get a random key
	$key = $array[0];

	// initialize arrays for storing 2 values
	$lessValues = $highValues = array();	  
	for ($i = 1; $i < $length; $i++) {
		if ($array[$i] <= $key) {
			$lessValues[] = $array[$i];
		} else {
			$highValues[] = $array[$i];
		}
	}
	
	/* 
	all values less than key are in lessValues and all greater than key are in highValues
	*/
	

	// quick sort both arrays recursively and merge with key in between

	return array_merge(
				quickSort($half1),
				array($key),
				quickSort($half2)
			);
} 
```

### File Uploads

A lot of stuff related to file uploads is handled by the browser. We just need to create a HTML form with multipart encoding like this:

```
<html>
<head>
    <title>PHP Form Upload</title>
</head>

<body>
    <form method='post' action='file_upload.php' enctype='multipart/form-data'>
        <label for="filename">Choose a file</label>
        <input type='file' name='filename' size='10' />
        <input type='submit' value='Upload' />
    </form>
</body>
</html>

``` 

This will upload the file to server and send the uploaded file to the file_upload.php file.

```

<?php

if ($_FILES) { 
	$name = $_FILES['filename']['name'];
	move_uploaded_file($_FILES['filename']['tmp_name'], $name);
	echo "Uploaded image $name";
	echo "<img src=". $name ."/>";
}

```

- `$_FILES[‘file’][‘name’]`  - The name of the uploaded file (e.g., smiley.jpg).
- `$_FILES[‘file’][‘type’]` - The content type of the file (e.g., image/jpeg).
- `$_FILES[‘file’][‘size’]` - The file’s size in bytes.
- `$_FILES[‘file’][‘tmp_name’]` - The name of the temporary file stored on the server.
- `$_FILES[‘file’][‘error’]`  - The error code resulting from the file upload.


*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*

<style>
p > strong:first-child {
    text-transform: uppercase;
	display: block;
    margin-top: 30px;
}
</style>
