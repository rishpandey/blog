---
extends: _layouts.post
section: content
title: "Getting Started with Web Development: Intro to MySql" 
date: 2021-04-05
categories: [basics]
---

MySQL is a database management software. A database is a structured collection of data, organized in ways to make common operations like searching and retrieving data, very efficient.

SQL is structured query language. MySQL is an open source implementation of SQL.

SQL Keywords:
- Database - A container of relevant MySQL data and tables.
- Table - A container for actual data. A table is a collection of rows and columns. Tables are also known as entities or relations.
- Rows - A row or record contains data for a single item or record in a table.
- Columns - A column or field contains data for a specific characteristic of the records in the table. 
- Relationships - A link between two tables.
- Datatypes - A column can only contain values of the same datatype example: int, varchar, text etc. 
- Keys 
	- Primary Keys - This is a unique identifier (a column) for a table used for efficient searching.
	- Foreign Keys - This is a link to another table’s primary key, used to establish a relationship between tables.


**Creating a database**

To be able to work with MySQL we need to create a database where we can store our tables.

`CREATE DATABASE sql_class;`

After creating the database we need to specify which database to use.

`USE sql_class;`


**Creating Users**

MySQL has a very sophisticated access control system.  There is a ‘root’ user which can access everything on MySQL. Root user is created when we install mysql. We should create a new user with every database and only allow access to the database to the new user.

```

> CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';

> GRANT ALL PRIVILEGES ON database_name.* TO 'newuser'@'localhost';

> FLUSH PRIVILEGES;

``` 


List of privileges
* ALL PRIVILEGES- as we saw previously, this would allow a MySQL user full access to a designated database (or if no database is selected, global access across the system)
* CREATE- allows them to create new tables or databases
* DROP- allows them to them to delete tables or databases
* DELETE- allows them to delete rows from tables
* INSERT- allows them to insert rows into tables
* SELECT- allows them to use the SELECT command to read through databases
* UPDATE- allow them to update table rows
* GRANT OPTION- allows them to grant or remove other users’ privileges

```
// allow/grant certain privilege
> GRANT type_of_permission ON database_name.table_name TO ‘username’@'localhost’;

// remove/revoke certain privilege
> REVOKE type_of_permission ON database_name.table_name FROM ‘username’@‘localhost’;

```


**Creating a table**

A table is a single entity like a user or blog_post and can have all data related to the entity.

```

> CREATE TABLE users ( 
	id int auto_increment,
	name VARCHAR(128), 
	title VARCHAR(128), 
	type VARCHAR(16), 
	birth_year CHAR(4),
	primary key(id)
) ENGINE MyISAM;

// Query OK, 0 rows affected (0.03 sec)

> DESC users; // shows table definition

```


Each column has the following info,
- Field - name of each field or column
- Type - datatype being stored in the field. 
- Null - Whether the field is allowed to contain a value of NULL. 
- Key - shows what type of key (if any) has been applied. 
- Default - default value that will be assigned if no value is specified .
- Extra Additional information like `auto_increment` or `CURRENT_TIMESTAMP`. 


**Data types**

Some basic types are as follows:

Numeric Types:
- INT - A standard integer
- BIGINT - A large integer
- DECIMAL - A fixed-point number
- DOUBLE - A double-precision floating point number
- BIT - A bit field

String Types:
- CHAR - A fixed-length nonbinary (character) string, 
- VARCHAR - A variable-length non-binary string
- BINARY - A fixed-length binary string
- BLOB - A small BLOB  
- TEXT - A small non-binary string
- ENUM - An enumeration; each column value may be assigned one enumeration member
- SET - A set; each column value may be assigned zero or more SET members

Date and Time Types:
- DATE - A date value in CCYY-MM-DD format
- TIME - A time value in hh:mm:ss format
- DATETIME - A date and time value inCCYY-MM-DD hh:mm:ssformat
- TIMESTAMP - A timestamp value in CCYY-MM-DD hh:mm:ss format
- YEAR - A year value in CCYY or YY format

- JSON - A new type which supports validation and efficient storage


**Inserting Records**

```

INSERT INTO users(name, title, type, birth_year) VALUES('Rish', 'Coder', 'Senior', 1995);

INSERT INTO users(name, title, type, birth_year) VALUES('Rishabh', 'COO', 'Management', 1991);

```


**Alter Table**

```
// rename table name
ALTER TABLE users RENAME user_info;

// change column name and datatype
ALTER TABLE user_info CHANGE type occupation varchar(50)

// add new coloumn
ALTER TABLE user_info ADD type varchar(50);

// remove column
ALTER TABLE user_info DROP occupation;

```

**Delete Table**

```

// deleting table data
TRUNCATE user_info;

// delete or drop table
DROP user_info;

```


**Querying a database**

- SELECT

```

// get all data
SELECT * FROM user_info; 

// get specific column
SELECT birth_year from user_info;

// get count of all records
SELECT COUNT(*) from user_info;

// get disctinct/non-duplicate records
SELECT DISTINCT(title) from user_info;

```

- Delete

```

// delete all data same as truncate
DELETE FROM user_info;

DELETE FROM user_INFO WHERE name = 'Rish';

```


- WHERE
This is used to filter other queries like select and delete.

```

// We can do arithmetic (>, <, >=, <=, =, !=) 
SELECT * FROM user_info WHERE id > 1;

// LIKE is used for string matching
SELECT * FROM user_info WHERE name LIKE 'RISH';

// LIKE with % is used to match substring, 
// % is here substituted for, ends with any string
SELECT * FROM user_info WHERE name LIKE 'RISH%';

```


- LIMIT
Used to set a limit to the number of records returned

```

// Returns first 2 rows
SELECT * FROM user_info LIMIT 2;

// Returns 2 row after the first row (skips 1st)
SELECT * FROM user_info LIMIT 1,2;

```

- ORDER BY
Used to sort the results by columns

```

SELECT * FROM user_info ORDER BY birth_year;

// Descending order
SELECT * FROM user_info ORDER BY birth_year DESC;

```

- GROUP BY
Used to group results. For example, if you want to know how many users are there in each birth year.

```

// AS is used to give alias to a result row
SELECT count(*) AS Total, birth_year FROM user_info GROUP BY birth_year;

```


**Update Records**

```

UPDATE user_info SET name='Rishabh' where id = 1;

UPDATE user_info SET name='Rishabh' where birth_year > 2000;

```

We can also use limit, order by and group by with update as well.


**Joins**
SQL is a RDBMS or Relational Database Management System. All data is stored using tables and relations between these tables. 

Let’s create another table,

```

CREATE TABLE payments(
	id INT AUTO_INCREMENT,
	total_price DOUBLE NOT NULL,
	user_id INT,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES user_info(id)
)ENGINE MyISAM;

```

Now this table has a relation to the user_info table via foreign key use\_id.

We can use joins to get the data for a related table.

```

// basic join

SELECT user_info.name, payments.total_price from user_info,payments WHERE user_info.id = payments.user_id;


// JOIN ON

SELECT user_info.name, payments.total_price from user_info JOIN payments ON user_info.id = payments.user_id;

// JOIN with WHERE

SELECT user_info.name, payments.total_price from user_info JOIN payments ON user_info.id = payments.user_id WHERE user_info.name = 'Rish';

```




### Normalization and Basics of Good DB Design

Normalization is the process of separating data into tables to make the database more efficient and avoid duplication. 

There are many normal forms in database design, we will learn about the first three as they are most important and apply everywhere.

- 1NF
	1. There should be no repeating columns containing the same kind of data. 
	2. All columns should contain a single value, multivalve column are inefficient. 
	3. There should be a primary key to uniquely identify each row.

This largely deals with removing duplication and redundancy in multiple columns.

```
Given: 

ID   Name   Courses
------------------
1    A      c1, c2
2    E      c3
3    M      C2, c3


Normalized - no multivalued cols

ID   Name   Course
------------------
1    A       c1
1    A       c2
2    E       c3
3    M       c2
3    M       c3

```

- 2NF
	1. Must be in 1NF.
	2. The table should have no partial dependencies. 

Partial Dependency occur when non prime attribute depends on the subset/part of candidates key (more than one primary key).

A candidate key is a column, or set of columns, in a table that can uniquely identify any database record without referring to any other data. 
Each table may have one or more candidate keys, but one candidate key is unique, and it is called the primary key.


Example:

Say we have a table:
Sellers (Id, Product, Price)

For this table we have,
Candidate Key: Id, Product
Non prime attribute : Price

Price attribute only depends on only Product attribute which is a subset of candidate key, not the whole candidate key(Id, Product) key. 
It is called partial dependency.

So we can say that Product->Price is partial dependency.
Creating another table with Product and Price will normalize this table in 2NF.

- 3NF
	1. Must be 2NF
	2. No transitive dependency for non prime attributes.

Data that is not dependent on primary key but that is dependent on another column should be moved to separate table.

Example: 
We have another table
Students (id, name, state, country, age)

Here the country does not depend directly on the id but depends on the state. So we need to create another table to normalize this into 3NF.

Students (id, name, state, age)
State_Country (state, country)

Another way to look at this is,
id->state and state->country.
Therefore, country is transitively dependent on id, and it violates 3NF.


### Transactions

Think of the following case,

- User purchases a product.
- The amount is deducted from user’s account.
- The purchase is confirmed.
- Delivery is schedules.

In situations like these, we have to make sure that all of the operations were successful. If let’s say the amount deduction failed, we can’t continue with the purchase and delivery. Not only is the order of queries is important in this transaction, but it is also vital that all parts of the transaction complete successfully.

To handle such cases we have Transactions in MySQL.

## MySQL with PHP

PHP and MySQL are a perfect pair. In most web applications we need to use some kind of persistence to store the user’s data. Databases and MySQL are the perfect solution for all our persistence needs as a web developer.

To work with a MySQL database in PHP, the process is
- Connect to MySQL
- Select the database
- Perform Query
- Retrieve results and output
- Disconnect


**Connecting to a Database**

```

<?php

$dbhost = 'localhost';
$dbuser = 'user';
$dbpass = 'pass';
$dbname = 'sqltest';

// establish connection
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}

$connection->close();



```

**Create a Table**

```

<?php

// connect to db

// sql to create table
$sql = <<<EOD
        CREATE TABLE addresses (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        street VARCHAR(30) NOT NULL,
        zip VARCHAR(8) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    EOD;

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();



```

**Perform Query**

```

// connect to db
...

$query = 'SELECT * FROM user_info';

// Perform query to get count
if ($result = $connection->query($query)){
	echo "Returned rows are: " . $result -> num_rows;
  
	// Free result set
  $result->free_result();
}

// Print data
if ($result = $connection->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    printf ("%s (%s)\n", $row['name'], $row['title']);
  }
  $result->free_result();
}

$mysqli -> close();


```


**Insert Data**

```

// connect to db

$sql = "INSERT INTO addresses (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($connection->query($sql) === TRUE) {
	$last_id = $connection->insert_id;
  echo "New record created successfully with id:$last_id";	
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



```

We can do update and delete similarly.


### Using PDO 

PDO stands for PHP data objects. PDO is the recommended way of working with databases now, as it works with 12 different databases including MySQL.

- Establishing a connection using PDO

```

<?php
  $host = 'localhost';
  $user = 'user';
  $password = 'pass';
  $dbname = 'sqltest';

  // Set DSN (Data Source Name)
  $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

  // Create a PDO instance
  $connection = new PDO($dsn, $user, $password);

  // Set PDO::FETCH_OBJ as fetch() default attributes
	// To return records as objects when fetch is called 
  $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
```

- Query the database

```

  // Select all users
	$stmt = $connection->query('SELECT * FROM user_info');

  // Display all names

  // PDO::FETCH_ASSOC: returns an assoc array indexed by column name as returned in your result set
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo $row['name'] . '<br>';
	}

	while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		echo $row->name . '<br>';
	}

```
  
- Prepared Statements
Prepared statements can help increase security by separating SQL logic from the data being supplied. This separation of logic and data can help prevent a very common type of vulnerability called an SQL injection attack.

```
  // UNSAFE
  // $sql = "SELECT * FROM posts WHERE author = '$author'";

  // FETCH MULTIPLE POSTS

  // User Input
  $title = 'CEO';
  $limit = 1;

  // Positional Params
  $sql = 'SELECT * FROM user_info WHERE title LIMIT ?';
  $stmt = $connection->prepare($sql);
  $stmt->execute([$title, $limit]);
  $users = $stmt->fetchAll();

  // Named Params
	$sql = 'SELECT * FROM user_info WHERE title = :title';
	$stmt = $connection->prepare($sql);
	$stmt->execute(['title' => $title]);
	$users = $stmt->fetchAll();
	
	// row count
	$userCount = $stmt->rowCount();

	// print 
  foreach ($users as $users) {
    echo $users->title . '<br>';
  }

```

- INSERT DATA

```
	$name = 'Joel Billy';
	$title = 'Rockstar';
	$birthYear = 1993;

	$sql = 'INSERT INTO user_info(name, title, birth_year) VALUES(:name, :title, :birthYear)';
	$stmt = $connection->prepare($sql);
	$stmt->execute(['name' => $name, 'title' => $title, 'birthYear' => $birthYear]);

	echo 'Post Added';


```

*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*


<style>
p > strong:first-child {
    text-transform: uppercase;
	display: block;
    margin-top: 30px;
}
</style>

