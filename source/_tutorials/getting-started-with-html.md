---
extends: _layouts.post
section: content
title: "Getting Started with Web Development: Intro to HTML"
excerpt: A crash course of everyone's favorite web markup language. 
date: 2021-03-20
categories: [basics]
---

HTML stands for Hyper Text Markup Language. HTML is the standard markup language for creating web pages and web applications. Every page you see on the web has some sort of HTML associated with it. Even the most minimal browser in the worlds needs to understand or parse HTML/CSS and Javascript to be able to show webpages.

By convention, an HTML file is saved with a .html or .htm extension.

Inside this file, we organise the content using tags. Tags wrap the content, and each tag gives a special meaning to the text it wraps. 



### HTML Page Structure

Things start with the Document Type Declaration (aka *doctype*), a way to tell the browser this is an HTML page, and which version of HTML we are using.

`<!DOCTYPE html>`

Then we have the html element, which has an opening and closing tag:

```
<!DOCTYPE html>
<html>
…
</html>
```

Most tags come in pairs with an opening tag and a closing tag. The closing tag is written the same as the opening tag, but with a ‘/‘.

**Element**
An element constitutes the whole *package*:
* starting tag
* text content (and possibly other elements)
* closing tag

If an element has doesn’t have a closing tag, it is only written with the starting tag, and it cannot contain any text content. Opening and closing tags are there to contain relevant information.

**Attributes**
The starting tag of an element can have special snippets of information we can attach, called attributes.

Attributes have the key=“value” syntax:

`<p class=“a-class”>A paragraph of text</p>`


The class and id attributes are two of the most common you will find used. They have a special meaning, and they are useful both in CSS and JavaScript.

The difference between the two is that an id is unique in the context of a web page; it cannot be duplicated. Classes, on the other hand, can appear multiple times on multiple elements. Plus, an id is just one value. class can hold multiple values, separated by a space.

`<p id="paragraph-1" class=“a-class b-class”>1st paragraph of text</p>`
`<p id="paragraph-2" class=“a-class b-class c-class”>2nd paragraph of text</p>`

**Whitespace**
In HTML, even if you add multiple white spaces into a line, it’s collapsed by the browser’s CSS engine.

```
<p>A paragraph of text</p>

<p>
	A paragraph of text
</p>

<p>

A paragraph of text         </p>
```

All three paragraphs are same here. There is a property in CSS to change this behaviour, more on that later.

Nested tags should be indented with 2 or 4 characters. This makes the document more readable. Readability is a very important metric of a good codebase. 

### Document Head

<head> contains special tags that define the document properties.

This is the first tag nested into the html i.e. the first tag after opening the html tag.



```
<!DOCTYPE html>
<html>
	<head>
		...
	</head>
</html>
```
 
The head tag is not used to show content on the webpage but to define the document properties. These properties are themselves stored in different tags so the head is just a container for other tags.

Most used tags in the head are following:

* **title** - used to set the page title. This title is showed on the browser tabs and search results.
* **script** - used to add javascript to the document.
* **noscript** - used to detect when scripts are disabled.
* **link** - used to add css file to the document.
* **style** - used to add inline styling in the document, rather than loading external file.
* **meta** - used for add metadata to the document for SEO and other uses.


### Document Body

The <body> tag has all the tags that define the document content, everything you see on the page.

There are two types of elements in body: block and inline.

Block elements, when positioned in the page, do not allow other elements next to them. To the left, or to the right. Inline elements instead can sit next to other inline elements.
Another difference is that inline elements can be contained in block elements. The reverse is not true.
 
Let’s see most common tags we’ll use in a HTML document body.

**Text Based**

- p - a block element that defines a paragraph of text. You can’t nest another element in a paragraph.
- span - an inline element that defines a part of text. You may use it to wrap around certain part of a paragraph and target it using CSS.
- br - an inline element which defines a line break. It doesn’t have a closing tag.
- hr - an inline element which defines a line break. It doesn’t have a closing tag.
- h1, h2, h3, h4, h5, h6 - These are heading tags in HTML, from biggest to smallest. These are also block elements and you can’t nest another element inside a heading.
- strong - This tag marks the text inside it as strong. 

There are many other text tags like em, quotes, pre etc. They are less used but you can check them out in the HTML documentation.


**Lists**

There are three types of lists in HTML.

* unordered lists 
* ordered lists
* definition lists 

Unordered and ordered lists are widely used, definition lists are not. 

```
<ul>
    <li>List item 1</li>
    <li>List item 2</li>
</ul>

```

	- List item 1
	- List item 2



```
<ol>
    <li>List item 1</li>
    <li>List item 2</li>
</ol>

```

	1. List item 1
	2. List item 2



```

List item 1
				List item 2
List item 3
				List item 4

``` 


```
<dl>
    <dt>List item 1</dt>
    <dd>List item 2</dd>
    <dt>List item 3</dt>
    <dd>List item 4</dd>
</dl>

```


List item 1
			List item 2
List item 3
			List item 4



**Links**
Links are defined using the a tag. The link destination is set via its “href” attribute.

`<a href=“https://rishpandey.com”>Check out</a>`


The above example uses an absolute URL, you can also give a relative URL to go a location on the current site.

`<a href=“/shop”>Go to shop</a>`


You can nest link tags with images and blocks rather than just texts. To open the link in a new tab, you can use the target attribute.

`<a href=“https://rishpandey.com” target="blank">Check out</a>`


**Container Tags**

These are most powerful tags in HTML as they can contain any set of tags inside them. 

* article
* section
* div

article
The article tag identifies something that can be independent from other things in a page. The article element represents a section of content that forms an independent part of a document or site; for example, a magazine or newspaper article, or a blog entry.

section
This represents a section of a document. Each section should have a heading tag (h1-h6) and the section body. This is used to break a long article or content into different parts.

div
This is the generic container element. It fits all shapes and forms to accommodate all your container needs. It almost always comes with a class or id attribute to this element, to allow it to be styled using CSS. 

**Page Tags**

These are the tags that are related to the whole page’s content.

- nav 
- header
- main
- footer


nav
This tag is used to create the markup that defines the page navigation. Into this we typically add an ul or ol list.

header
The header tag represents a part of the page that is the introduction. It can for example contain one or more heading tag (h1-h6), the tagline for the article, an image.

main
This represents the main part of a page. 

footer
The footer tag is used to determine the footer of an article or the page:


HTML is a very forgiving language. To use these tags correctly is entirely upto the user’s judgement. You can have page with nothing but div tags or a page with every tag supported by HTML. 
The right way to write HTML is using specific tags for specific purposes, leave styling to CSS and keeping the tags consistent throughout the site. 


### Forms
Forms are meant to interact with an application. A form is used to send some data or information from the client (browser) to the server. By default this data sending causes the page to reload after the data is sent, but using JavaScript and AJAX you can alter this behavior.

**Method Attribute**
By default forms are submitted using the GET HTTP method. Which has its drawbacks, and usually you want to use POST. To specific which method to use we do 

`method=“POST”`

**Action Attribute**
To specify the server location where we wish to send the data, we use the action attribute. Handling a form action is the responsibility of a web server. The server must listen to a form submit event on a location or URL. This URL is specified in action.

```
<form action=“/store-user” method=“POST”>
	...
</form>
```

A form is used to send data to the server. For adding the data to a form we have several form fields which respond to each content type.

Most commonly we use the following fields.
* input boxes (single line text)
* text areas (multiline text)
* select boxes (choose one option from a drop-down menu)
* radio buttons (choose one option from a list always visible)
* checkboxes (choose zero, one or more option)
* file uploads


**Input Tag**
The input field is one of the most widely used form elements. It’s also a very versatile element, and it can completely change behavior based on the “type” attribute. 

There are many types like,

- text - basic text input and the default input type.

` <input type=“text” name=“username”>`

- password - text input which doesn’t reveal the input characters.

`<input type=“password” name=“password”>`

- email - input field that checks if the given email is valid email format.

`<input type=“email” name=“email”>`

- number - an input element that accepts only numbers.

`<input type=“number” name=“age” placeholder=“Your age”>`

- hidden - an input hidden from the user. This is used to store values like a user identification which we wouldn’t want the user to change in page.

`<input type=“hidden” name=“user-id” value=“88273”>`


- file 
A file input used to upload documents on the server.

`<input type=“file” name=“user-identification-document”>`


- submit 
A button field used to submit the form, value attribute is used for the button.

`<input type=“submit” value=“Submit form”>`

- button 
Another button field to perform any action other than submitting the form.

`<input type=“button” value=“Some action”>`

- checkbox
These allow us to choose multiple values or none. All checkboxes are unchecked by default, you can use the “checked” to check them by default.

```
<input type=“checkbox” name=“color” value=“yellow”>
<input type=“checkbox” name=“color” value=“red”>
<input type=“checkbox” name=“color” value=“blue”>
```

- Radio buttons
These are used to create a set of choice. User can select only one of the available options in radio fields.

```
<input type=“radio” name=“color” value=“yellow”>
<input type=“radio” name=“color” value=“red”>
<input type=“radio” name=“color” value=“blue”>
```

- Date and time
An input field used to enter a date or time. It also supports types like time, month, week etc.

```
<input type="time" name="booking-time">
<input type="date" name="booking-date">
```


Useful Attributes
- placeholder - To show a message to user on the input area
- value - set a default value for some input fields
- required - a validation measure to ensure that the field isn’t empty while submitting the form.

There are many other types in input field like url, type, tel.


**Textarea tag**
Textarea is used to enter multi-line input, the dimensions are set using the rows and cols.

`<textarea rows=“20” cols=“10” name="description"></textarea>`


**Select Tag**
This is used to create a dropdown menu. Each option in a dropdown is created using the “option” tag, each option has a value which is used to by the server to find which option was selected.

```
<select name="color">
    <option value="">None</option>
    <option value="red">Red</option>
    <option value="yellow">Yellow</option>
</select>
```


**Tables Tag**
Tables are used to create tables in a webpage. Each table has a rows and columns. A row is created using the <tr> tag and columns are created by <td>. We can also use a th to specify a table a row header for the table.


```
<table>
  <tr>
    <th>Column 1</th>
    <th>Column 2</th>
    <th>Column 3</th>
  </tr>
  <tr>
    <td>Row 1 Column 1</td>
    <td>Row 1 Column 2</td>
    <td>Row 1 Column 3</td>
  </tr>
  <tr>
    <td>Row 2 Column 1</td>
    <td>Row 2 Column 2</td>
    <td>Row 2 Column 3</td>
  </tr>
</table>
```

Tables are very powerful in HTML and developers used to use them for a lot before CSS came around.

**Img Tag**
Img tag is used to add images to the webpage. The src attribute is used to give the location of the image, it can be a URL or a local file. The HTML standard requires an alt attribute to be present, to describe the image. This is used by screen readers and also by search engine bots:

`<img src=“dog.png” alt=“A picture of a dog”>`


**Audio Tag**

This tag allows is used to embed audio content in HTML pages. This element can play an audio source given in the src attribute. Adding controls will allow us to show a audio player which can be used play/pause and adjust volume of the audio.

`<audio src=“file.mp3” controls>`


**Video Tag**

This tag allows you to embed video content in HTML pages. This element can play a video source which you reference using the src attribute. Adding controls will allow us to show a video player similar to the audio controls with some options to control the video playback.

`<video src=“file.mp4” controls>`


Both video and audio tags allow attributes like muted, autoplay and loop. And provide events in javascript, which can be used to control the playback programmatically.

**Iframes**

The iframe tag allows us to embed content coming from other origins (other sites) into our web page. An iframe creates a new nested browsing context, anything in the iframe does not interfere with the parent page, and vice versa. You will not see a lot of frames in new websites as it affects performance and is not great for accessibility.

`<iframe src=“https://google.com”></iframe>`


*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*


<style>
p > strong:first-child {
    text-transform: uppercase;
	display: block;
    margin-top: 30px;
}
</style>
