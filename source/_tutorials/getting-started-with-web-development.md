---
extends: _layouts.post
section: content
title: "Getting Started with Web Development"
excerpt: The compilation of all lessons in the web development bootcamp.
date: 2021-04-15
categories: [basics]
keywords: web development, internet, html, css, javascript, web applications, web pages
---

# Intro to the Web and the Internet

**How does the Internet Work?**<br>
The Internet works through a packet routing network in accordance with the *Internet Protocol (IP)*, the *Transport Control Protocol* (TCP) and other protocols.

**What’s a protocol?**<br>
A protocol is a set of rules specifying how computers should communicate with each other over a network. For example, the *Transport Control Protocol* has a rule that if one computer sends data to another computer, the destination computer should let the source computer know if any data was missing so the source computer can re-send it. Or the *Internet Protocol* which specifies how computers should route information to other computers by attaching addresses onto the data it sends.

**What’s a packet?**<br>
Data sent across the Internet is called a *message*. Before a *message* is sent, it is first split in many fragments called *packets*. These *packets* are sent independently of each other. The typical maximum *packet* size is between 1000 and 3000 characters. The *Internet Protocol* specifies how messages should be packetized.

**What’s a packet routing network?**<br>
It is a network that routes *packets* from a source computer to a destination computer. The Internet is made up of a massive network of specialized computers called *routers*. Each *router’s* job is to know how to move *packets* along from their source to their destination. A *packet* will have moved through multiple *routers* during its journey.

When a *packet* moves from one *router* to the next, it’s called a *hop*.
You can use the command line-tool traceroute to see the list of hops packets take between you and a host.

> traceroute -I 8.8.8.8

The *Internet Protocol* specifies how network *addresses*should be attached to the *packet’s* *headers,*a designated space in the *packet* containing its meta-data. The *Internet Protocol* also specifies how the *routers* should forward the *packets* based on the *address* in the *header*.

**Where did these Internet routers come from? Who owns them?**<br>
These *routers* originated in the 1960s as *ARPANET*, a military project whose goal was a computer network that was decentralized so the government could access and distribute information in the case of a catastrophic event. Since then, a number of *Internet Service Providers* (ISP) corporations have added *routers* onto these *ARPANET* *routers*.
There is no single owner of these Internet *routers*, but rather multiple owners: The government agencies and universities associated with *ARPANET* in the early days and *ISP* corporations like AT&T and Verizon later on.
Asking who owns the Internet is like asking who owns all the telephone lines. No one entity owns them all; many different entities own parts of them.

**Do the packets always arrive in order? If not, how is the message re-assembled?**<br>
The *packets* may arrive at their destination out of order. This happens when a later *packet* finds a quicker path to the destination than an earlier one. But *packet’s header* contains information about the *packet’s* order relative to the entire *message*. The *Transport Control Protocol* uses this info for reconstructing the message at the destination.

**Do packets always make it to their destination?**<br>
The *Internet Protocol*makes no guarantee that *packets* will always arrive at their destinations. When that happens, it’s called called a *packet loss*. This typically happens when a *router* receives more *packets* it can process. It has no option other than to drop some *packets*.
However, the *Transport Control Protocol* handles *packet loss* by performing re-transmissions. It does this by having the destination computer periodically send acknowledgement *packets* back to the source computer indicating how much of the message it has received and reconstructed. If the destination computer finds there are missing *packets*, it sends a request to the source computer asking it to resend the missing *packets*.
When two computers are communicating through the *Transport Control Protocol,*we say there is a *TCP connection* between them.

**What do these Internet addresses look like?**<br>
These *addresses* are called *IP addresses* and there are two standards.
The first address standard is called *IPv4* and it looks like 212.78.1.25 . But because *IPv4* supports only 2³² (about 4 billion) possible addresses, the  [Internet Task Force](https://en.wikipedia.org/wiki/Internet_Engineering_Task_Force)  proposed a new address standard called *IPv6*, which look like 3ffe:1893:3452:4:345:f345:f345:42fc . *IPv6* supports 2¹²⁸ possible addresses, allowing for much more networked devices, which will be plenty more than the as of 2017 current 8+ billion networked devices on the Internet.
As such, there is a one-to-one mapping between *IPv4* and *IPv6* addresses. Note the switch from *IPv4* to *IPv6* is still in progress and will take a long time. As of 2014, Google revealed their *IPv6* traffic was only at 3%.

**How can there be over 8 billion networked devices on the Internet if there are only about 4 billion IPv4 addresses?**<br>
It’s because there are *public* and *private IP addresses.* Multiple devices on a local network connected to the Internet will share the same *public IP address*. Within the local network, these devices are differentiated from each other by *private IP addresses*, typically of the form 192.168.xx or 172.16.x.x or 10.x.x.x where x is a number between 1 and 255. These *private IP addresses* are assigned by * .* [Dynamic Host Configuration Protocol (DHCP)](https://en.wikipedia.org/wiki/Dynamic_Host_Configuration_Protocol)
For example, if a laptop and a smart phone on the same local network both make a request to www.google.com, before the *packets* leave the modem, it modifies the *packet headers* and assigns one of its ports to that *packet*. When the google server responds to the requests, it sends data back to the modem at this specific port, so the modem will know whether to route the *packets* to the laptop or the smart phone.
In this sense,*IP addresses* aren’t specific to a computer, but more the connection which the computer connects to the Internet with. The address that is unique to your computer is the  [MAC address](https://en.wikipedia.org/wiki/MAC_address) , which never changes throughout the life of the computer.
This protocol of mapping *private IP addresses* to *public* *IP* *addresses* is called the *Network Address Translation*(NAT) protocol. It’s what makes it possible to support 8+ billion networked devices with only 4 billion possible *IPv4* addresses.

**How does the router know where to send a packet? Does it need to know where all the IP addresses are on the Internet?**<br>
Every *router* does not need to know where every *IP address* is. It only needs to know which one of its neighbors, called an *outbound link,*to route each packet to. Note that *IP Addresses* can be broken down into two parts, a *network prefix* and a *host identifier*.

For example, 129.42.13.69 can be broken down into
Network Prefix: 129.42
Host Identifier: 13.69
All networked devices that connect to the Internet through a single connection (ie. college campus, a business, or ISP in metro area) will all share the same *network prefix*.
Routers will send all packets of the form 129.42.*.* to the same location. So instead of keeping track of billions of *IP addresses*, *routers* only need to keep track of less than a million *network prefix*.

But a router still needs to know a lot of network prefixes . If a new router is added to the Internet how does it know how to handle packets for all these network prefixes?
A new *router* may come with a few preconfigured routes. But if it encounters a *packet* it does not know how to route, it queries one of its neighboring *routers*. If the neighbor knows how to route the *packet*, it sends that info back to the requesting *router*. The requesting *router* will save this info for future use. In this way, a new router builds up its own *routing table*, a database of *network prefixes* to *outbound links*. If the neighboring *router* does not know, it queries its neighbors and so on.

**How do networked computers figure out ip addresses based on domain names?**<br>
We call looking up the*IP address* of a human-readable domain name like www.google.com “resolving the IP address”. Computers resolve IP addresses through the *Domain Name System* (*DNS*), a decentralized database of mappings from *domain names* to *IP addresses*.
To resolve an IP address, the computer first checks its local *DNS* cache, which stores the *IP address* of web sites it has visited recently. If it can’t find the *IP address* there or that  [IP address record has expired](https://en.wikipedia.org/wiki/Time_to_live#DNS_records) , it queries the *ISP’s* *DNS* servers which are dedicated to resolving IP addresses. If the *ISP’s* *DNS* servers can’t find resolve the *IP address*, they query the  [root name servers](https://www.iana.org/domains/root/servers) , which can resolve every domain name for a given  [top-level domain](https://www.iana.org/domains/root/db)  . *Top-level domains* are the words to the right of the right-most period in a domain name. .com .net .org are some examples of *top-level domains*.

**How do applications communicate over the Internet?**<br>
Like many other complex engineering projects, the Internet is broken down into smaller independent components, which work together through well-defined interfaces. These components are called the *Internet Network Layers*and they consist of *Link Layer*,*Internet Layer*, *Transport Layer*, and *Application Layer*. These are called layers because they are built on top of each other; each layer uses the capabilities of the layers beneath it without worrying about its implementation details.
￼
Internet applications work at the *Application Layer* and don’t need to worry about the details in the underlying layers. For example, an application connects to another application on the network via TCP using a construct called a  [socket](http://pubs.opengroup.org/onlinepubs/009695399/basedefs/sys/socket.h.html) , which abstracts away the gritty details of routing *packets* and re-assembling *packets* into *messages*.

**What do each of these Internet layers do?**<br>
At the lowest level is the *Link Layer* which is the “physical layer” of the Internet. The *Link Layer* is concerned with transmitting data bits through some physical medium like fiber-optic cables or wifi radio signals.
On top of the *Link Layer* is the *Internet Layer*. The *Internet Layer* is concerned with routing packets to their destinations. The *Internet Protocol* mentioned earlier lives in this layer (hence the same name). The *Internet Protocol* dynamically adjusts and reroutes *packets* based on network load or outages. Note it does not guarantee *packets* always make it to their destination, it just tries the best it can.
On top of the *Internet Layer* is the *Transport Layer*. This layer is to compensate for the fact that data can be loss in the*Internet* and *Link* layers below. The *Transport Control Protocol* mentioned earlier lives at this layer, and it works primarily to re-assembly packets into their original *messages* and also re-transmit *packets* that were loss.
The *Application Layer* sits on top. This layer uses all the layers below to handle the complex details of moving the packets across the Internet. It lets applications easily make connections with other applications on the Internet with simple abstractions like  [sockets](http://pubs.opengroup.org/onlinepubs/009695399/basedefs/sys/socket.h.html) . The  [HTTP protocol](https://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol)  which specifies how web browsers and web servers should interact lives in the *Application Layer*. The  [IMAP protocol](https://en.wikipedia.org/wiki/Internet_Message_Access_Protocol)  which specifies how email clients should retrieve email lives in the *Application Layer*. The  [FTP protocol](https://en.wikipedia.org/wiki/File_Transfer_Protocol)  which specifies a file-transferring protocol between file-downloading clients and file-hosting servers lives in the *Application Layer*.

**What’s a client versus a server?**<br>
While*clients* and *servers* are both applications that communicate over the Internet, *clients* are “closer to the user” in that they are more user-facing applications like web browsers, email clients, or smart phone apps. *Servers* are applications running on a remote computer which the *client* communicates over the Internet when it needs to.
A more formal definition is that the application that initiates a *TCP connection* is the *client*, while the application that receives the *TCP connection* is the *server*.

**How can sensitive data like credit cards be transmitted securely over the Internet?**<br>
In the early days of the Internet, it was enough to ensure that the network *routers* and links are in physically secure locations. But as the Internet grew in size, more *routers* meant more points of vulnerability. Furthermore, with the advent of wireless technologies like WiFi, hackers could intercept *packets* in the air; it was not enough to just ensure the network hardware was physically safe. The solution to this was *encryption* and *authentication* through *SSL/TLS*.

**What is SSL/TLS?**<br>
*SSL* stands for *Secured Sockets Layer.* *TLS* stands for *Transport Layer Security*. *SSL* was first developed by Netscape in 1994 but a later more secure version was devised and renamed *TLS*. We will refer to them together as *SSL/TLS*.
*SSL/TLS* is an optional layer that sits between the *Transport Layer* and the *Application Layer*. It allows secure Internet communication of sensitive information through *encryption* and *authentication*.
*Encryption* means the *client* can request that the *TCP connection* to the *server* be encrypted. This means all *messages* sent between *client* and *server* will be encrypted before breaking it into *packets*. If hackers intercept these *packets*, they would not be able to reconstruct the original *message*.
*Authentication* means the *client* can trust that the *server* is who it claims to be. This protects against  [man-in-the-middle attacks](https://en.wikipedia.org/wiki/Man-in-the-middle_attack) , which is when a malicious party intercepts the connection between *client* and *server* to eavesdrop and tamper with their communication.
We see *SSL* in action whenever we visit SSL-enabled websites on modern browsers. When the browser requests a web site using the https protocol instead of http, it’s telling the web server it wants an *SSL* encrypted connection. If the web server supports *SSL*, a secure encrypted connection is made and we would see a lock icon next to the address bar on the browser.

**How does SSL authenticate the identity of a server and encrypt their communication?**<br>
It uses *asymmetric encryption*and*SSL certificates.*
*Asymmetric encryption*is an encryption scheme which uses a *public key* and a *private key.*These keys are basically just numbers derived from large primes. The *private key* is used to decrypt data and sign documents. The *public key* is used to encrypt data and verify signed documents. Unlike *symmetric encryption*, *asymmetric encryption* means the ability to encrypt does not automatically confer the ability to decrypt. It does this by using principles in  [a mathematical branch called number theory](https://medium.com/@User3141592/notes-on-computational-cryptography-98db5f2908f1) .
An *SSL certificate* is a digital document that consists of a *public key* assigned to a web server. These *SSL certificates* are issued to the *server* by  [certificate authorities](https://en.wikipedia.org/wiki/Certificate_authority) . Operating systems, mobile devices, and browsers come with a database of some *certificate authorities* so it can verify*SSL certificates.*
When a *client* requests an SSL-encrypted connection with a *server*, the *server* sends back its *SSL certificate*. The *client* checks that the *SSL certificate*
* is issued to this *server*
* is signed by a trusted *certificate authority*
* has not expired.
The *client* then uses the *SSL certificate’s public key* to encrypt a randomly generated *temporary secret key* and send it back to the *server*. Because the *server* has the corresponding *private key*, it can decrypt the client’s *temporary secret key*. Now both *client* and *server* know this *temporary secret key*, so they can both use it to symmetrically encrypt the *messages* they send to each other. They will discard this *temporary secret key* after their session is over.

**What happens if a hacker intercepts an SSL-encrypted session?**<br>
Suppose a hacker intercepted every *message* sent between the *client* and the *server*. The hacker sees the *SSL certificate* the *server* sends as well as the *client’s* encrypted *temporary secret key.*But because the hacker doesn’t have the *private key* it can’t decrypt the *temporarily secret key*. And because it doesn’t have the *temporary secret key*, it can’t decrypt any of the *messages* between the *client* and *server.*


**How a common web application works**

So, the basic three-step process of the Web application:

1. The browser (the client) sends a request to the server (the Web Server) over the network (the Internet or Intranet) in the form of a link on a Web page, a Web address (URL) or an HTML.
2. The Server runs an application that provides the requested service (data-entry, data-processing, data retrieval).
3. When the application closes, the Server returns some kind of response page back over the wire to the Browser. It may be an updated copy of the same page, an error page, a response page or just another blank data-entry form.


There you go, that’s a Web application.


*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*


---

# Intro to HTML


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
* unordered lists - <ul>
* ordered lists - <ol>
* definition lists - <dl>

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

---

# Intro to CSS


CSS or Cascading Style Sheets is the language that we use to style an HTML file, and tell the browser how should it render the elements on the page.

A CSS file contains a bunch of rules that define how everything should be constructed on the HTML page. All of these rules have 2 parts,

- selector
- declaration block

A selector is used to specify which element should be styled and the declaration block specifies the actual style. Both of these together can be called a rule set. All CSS is nothing else but a bunch of rule sets.

```
p {
	font-size: 18px;
	color: yellow;
}

div {
	background-color: blue;
}
```




There are three ways to add CSS to a HTML Page

- link tag

`<link rel=“stylesheet” type=“text/css” href=“style.css”>`

- style tag

```
<style>
	...
</style>
```

- inline style

`<div style="">...</div>`



## Selectors

A selector is used to target a specific element or a set of elements on the page.

Every HTML tag has a corresponding selector, for example: div, span, img. If a selector matches multiple elements, all the elements in the page will be affected by the change.

As we learned in the HTML, there are two attributes which are commonly used to target elements. The class and id attributes, and the class can be repeated while the same id is only used for a single element.

- Classes are identified using the . symbol, while ids using the # symbol.

The whole point of keeping multiple elements with the same class name is that we are able to style all these elements by targeting the class.

```
<div>
	<p id="owner-name">John Doe</p>

	<p class="pet-name">Jojo</p>
	<p class="pet-name">Pogo</p>
</div>


// select by class

.pet-name {
  color: yellow;
}

// select by id

#owner-name {
  color: blue;
}

```

**More selectors**

- We can also target specific element that has a class or id.

```

<div class="card">
	<h2 id="welcome-message">Welcome to Site</h2>
	<p>We hope you have fun.</p>
</div>

div.card{
	border: solid;
}

h2#welcome-message{
	color: blue;
}
```

- We can also target multiple classes by combining class names, like this.

```

<div class="card">
	<h2 id="welcome-message">Welcome to Site</h2>
	<p class="message left">We hope you have fun.</p>
	<p class="message right">And you visit again.</p>
</div>

.message.left{
	float: left;
}
.message.right{
	float: right;
}
```

Classes and ids can also be combined similarly.

- We can apply same rules to multiple selectors by adding a comma between selectors.

```
<h3>My name is Rish</h3>

<p class="action">And I am here to help you.</p>

h3, .action {
  color: blue;
}

```

- We can create a more specific selector by combining multiple items to follow the document tree structure.

```

<div>....</div>
<div>
	<p>
  		My name is:
  		<span class="name">
  		  Rish
	 	</span>
	</p>

div p span.name {
  color: yellow;
}


```

The above selector will also work if the nested element is deeper in the structure. To get just the first level deep span we can use ‘>’  instead of space (‘ ’).

- We have more selectors we can use like,
	* attribute selectors -
	These are used to select an element by its attribute. For example, a		paragraph with id message can be selected by **p[id=“message”]**.

	* pseudo class selectors
	Pseudo classes are predefined keywords that are used to select an 		element based on its state, or to target a specific child. There are 		many pseudo-classes like active, checked, disabled, hover, last-child 		etc. For example, a disabled can be selected by using a colon (:) like 		button:disabled.

	* pseudo element selectors
	Pseudo elements are used to style a part of an element, there are five 		supported pseudo elements,
		- ::after - create pseudo element after the element
		- ::before - create pseudo element before the element
		- ::first-letter - style the first letter of text block
		- ::first-line - style the first line of text block
		- ::selection - target the selected text


## Style Rules

**Colors**

We can add any color to our elements using three properties,
- color - sets the color of text.
- background-color  - sets the color of the background.
- border-color - set a color for the element’s border

To select a color we have
- named color - a huge list of colors by name like red, blue, aqua, plum etc.
- RGB and RGBa - RGB notation allow us to set color based on red-green-blue from 0 to 255. RGBa allows us to add an alpha unit (0 to 1) which controls the transparency.
- Color Hex - The hexadecimal notation lets us express a number from 0 to 255 in just 2 digits, since they can go from 0 to “15” (f). So a RGB color can be expressed with 6 digits like rob(255,255,255) is FFFFFF.

```

<p>
This is a new <span>episode</span>.
<p>

p{
	color: white;
	background-color: rgb(0, 0, 0); // black
}

p span{
	color: rgba(255, 255, 255, 0.8);
	border-color: #ccc; // grey and same as #cccccc
}

```


**Units**

There are many units supported in CSS which can be used to assign height, width, padding, margins etc. to elements.

Most commonly we use,
- px - Not the physical pixel on screen. This is the most common measurement unit you’ll find in CSS.
- % - This allows us to specify a value based on the parent element’s corresponding property.
- em - is the value assigned to element’s font-size, so the rule is relative to the font-size of the element (2em means 2 times the size of the current font)
- rem - Relative to font-size of the root element (html). We set that font size once, and rem will be a consistent measure across all the page.
- vw - Relative to 1% of the width of the viewport. The viewport is the user’s visible area of a web page.
- vh - Relative to 1% of the height of the viewport.

There are also physical units like cm, mm, q (quarter of mm), in (inch) etc. These are used in print stylesheets which are used when we need to print a HTML document and are almost useless for screens.


**URL**

We can use @import to add another css file in the current one.

`@import url(anotherfile.css)`

To do import or add something like a background image we use the url method which searched the file relative to current directory of the css file or an external url.

```
div {
  background-image: url(logo.png);
}

```


**CALC**

The calc() function lets us perform basic math operations on values. Let’s say we need to have a div which is 20px less than 50% of the parent’s width.

```
div {
  width: calc(50% - 20px);
}
```


We can do addition, subtraction, multiplication and division in calc.

**Backgrounds**

There are many properties related to backgrounds, mostly we will need:
* background-color - sets a background color
* background-image - sets a background image with url()
* background-clip - defines how far the background (color or image) should extend within an element.
* background-position - sets a position of background within the element
* background-origin - sets the background’s origin from the border start, inside the border, or inside the padding.
* background-repeat - sets if a background should repeat and how
* background-attachment -  sets whether a background image scrolls with the rest of the page, or is fixed
* background-size - sets the size of background and how much area it covers.

There is also a shorthand to apply multiple rules at once with a background.

background: bg-color bg-image position/bg-size bg-repeat bg-origin bg-clip bg-attachment;


**Fonts**

Just like background the font property is a shorthand for a number of properties.

* font-family - sets the font type like ‘Sans Serif’ or ‘Open Sans’
* font-weight - sets the boldness of a font
* font-stretch - sets a narrow or wide face of the font, if available
* font-style - sets whether the font is italic or normal
* font-size - sets the size of font in px, %, em or rem

```
font: <font-stretch> <font-style> <font-variant> <font-weight> <font-size> <line-height> <font-family>;
```

**How to load a custom font?**
@font-face lets you add a new font family name, and map it to a file that holds a font. This file is usually one of the following type
- woff (Web Open Font Format)
* woff2 (Web Open Font Format 2.0)
* eot (Embedded Open Type)
* otf (OpenType Font)
* ttf (TrueType Font)

To add a new font we can do something like,

```
// url is relative to the css file's directory

@font-face {
  font-family: myFontName;
  src: url(sansation_light.woff);
}

p {
  font-family: myFirstFont;
}

```


**Font Styling**

There are many rules available for typography. The most common ones are:

* text-transform - sets the case of the text: lowercase, uppercase, capitalize or normal.
* text-decoration - adds decoration to the text: underline, line-through etc
* text-align - sets the alignment of the text: start, end, left, right, center and justify.
* vertical-align - sets the vertical alignment of inline elements: baseline, top, middle, bottom etc.
* line-height - sets the line height of the text that is how much vertical space a line of text takes.
* word-spacing - modifies the distance between two words.
* letter-spacing - modifies the distance between two letters.
* text-shadow - adds a shadow to text.

text-shadow: h-shadow v-shadow blur-radius color;
text-shadow: 2px 2px 8px #FF0000;


### Box Model

![Box Model](https://hackernoon.com/hn-images/1*2jZwpWH9XO_QllhEpyGqMA.png)


The box model explains the sizing of the elements based on a few CSS properties. Every element in CSS is like a generic box.

Starting from inside to outside we have: content area, padding, border and margin. Margin is the outer most layer of the box and touches the edge of box. You can open the dev tools on any browser and see this box model by clicking inspect.

By default, when we set a width (or height) on the element it is applied to the content area. All the padding, border, and margin are done outside of the value, so we have to keep this in mind when you do your calculation.

MARGIN
The margin CSS property is used to add space around the element. The margin exists outside the border and touches the box model edges.

Margin has 4 properties, each relative to one side of the element box. Margin can be used as a shorthand for these.

* margin-top
* margin-right
* margin-bottom
* margin-left

We can set margin in the following ways:

```
We can use any unit like px, %, rem etc.

div{
	margin-top: 10px;
	margin-right: 5px;
	margin-bottom: 10px;
	margin-left: 5px;
}

div{
	margin: 10px; // all side padding 10px
}

// top and bottom - 10 px
// right and left - 5 px
div{
	margin: 10px 5px;
}

// the order is top-right-bottom-left
div{
	margin: 10px 5px 10px 5px;
}


```

PADDING
The padding CSS property is used to add space in the inner side of an element. The padding exists between the content area and border.

Padding has 4 properties, each relative to one side of the element box. Padding can be used as a shorthand for these.

* padding-top
* padding-right
* padding-bottom
* padding-left

We can set padding in the following ways:

```
We can use any unit like px, %, rem etc.

div{
	padding-top: 10px;
	padding-right: 5px;
	padding-bottom: 10px;
	padding-left: 5px;
}

div{
	padding: 10px; // all side padding 10px
}

// top and bottom - 10 px
// right and left - 5 px
div{
	padding: 10px 5px;
}

// the order is top-right-bottom-left
div{
	padding: 10px 5px 10px 5px;
}


```


Note:
* margin adds space outside an element border
* padding adds space inside an element border



BORDER
The border is a thin layer between padding and margin. By setting the border, we can make elements draw their outline on screen.

* border-style - sets the style of the border like: solid, double, dashed etc.
* border-color -  sets the color of the border
* border-width - sets the border width or boldness: thin, medium and thick.

The border property is used as a shorthand for all of these.
border: <border-width> <border-color> <border-style>;

- border-radius - sets the curve on the border edges, can be used to create rounded corners.


BOX SIZING

The default behavior of applying the width and height to content area without taking padding, border or margin into account can be changed.

The box-sizing property has 2 values:
* border-box - setting this will make width and height calculation include the padding and the border.
* content-box - default
```
div {
  box-sizing: border-box;
}

```


### Display

The display property of an object determines how it is rendered by the browser.  This is a very important property and allows us to align elements easily.

There are many different display properties supported like:
* block
* inline
* table
* flex
* grid
* list-item
* inline-block
* inline-table
* inline-flex
* inline-grid
* inline-list-item

And more. We will look at the basic ones now. We’ll not cover others including table, flex and grid. These are very important and you are advised to learn them on your own.


Inline
All elements except div, p, ul and section are inline by default (these three are block). Inline elements have no margin or padding and any height and width properties will have no effect.

Inline-block
Same as inline-block block but you can have height and width.

Block
Block displayed items are stacked one after other vertical and takes 100% of the parent. So, it starts on a new line, and takes up the whole width. The values assigned to the width and height properties are applied, if you set them, along with margin and padding.

None
Using display: none makes an element disappear. The item will not show up on the Html document. We can use this to hide status messages and alerts and switch the property when it’s relevant for them to be visible.


### Positioning

The position CSS property allows us to move element around and position it exactly where we want.

It can have those 5 values:
* static
default setting and always positioned according to the normal flow of the page.

* relative
This allows us to position an element using an offset like top, bottom, right and left. Setting these four will move the element relative to its normal position.

* absolute
An element with position: absolute; is positioned relative to the nearest parent with a relative or absolute display. If an absolute positioned element has no positioned parent, it uses the document body. This setting on an element will remove it from the document’s flow.

* fixed
An element with position: fixed; is positioned relative to the viewport, and it always stays in the same place even if the page is scrolled. The top, right, bottom, and left properties are used to position the element.

* sticky
This is positioned based on the user’s scroll position. A sticky element toggles between relative and fixed, depending on the scroll position. Sticky positioning is a hybrid of relative and fixed positioning. The element is treated as relative positioned until it crosses a specified threshold, at which point it is treated as fixed positioned.

We can set top, left, bottom and right using any unit and it also supports negative values.

### Float

Floating is used to place content on one side of the container (parent) element. The float property is used for positioning and formatting content e.g. let an image float left to the text in a container.

The float property can have one of the following values:
* left - The element floats to the left of its container
* right - The element floats to the right of its container
* none - This is default, element does not float.

There is a clear property which specifies on which sides of an element floating elements are not allowed to float.

If an element can fit horizontally in the space next to another element which is floated, it will. Unless you apply clear to that element in the same direction as the float. Then the element will move down below the floated element. You can think of clear like it clears any unwanted float that may get applied to it because of empty space in floated sibling elements.

clear: both | left | right ;

```

<p>...</p>

<img src="pineapple.jpg" alt="Pineapple">

<p id="p2">...</p>


img{
	float: right;
}

p#p2{
	clear: both;
}
```


### Lists

Lists are super useful in web pages. A list of items, navbars and many more things are made using lists.

There are many properties to style <li> like these:
- list-style-type - sets the bullet point type like square, circle, disc or none.
- list-style-image - sets an image for the bullet point
- list-style-position - sets the position of the bullet points: inside or outside. Inside means that bullet point will be inside the list, outside is the default.

Like many other list-style provides a shorthand like:

  list-style: <list-style-type> <list-style-position> <list-style-image>;

### Responsive Design and Media Queries

There are several media types supported by CSS like:
- all - applies on all media types
- screen - used for screen (default)
- print - used for printing
- speech - used for screen readers

Media queries are useful when you want to modify your site or app depending on a device’s general type (such as print vs. screen) or specific characteristics and parameters (such as screen resolution or browser viewport width). So we can apply css to any media type (screen, print etc) or any device width like a mobile, tablet or desktop.

Targeting media types
Although websites are commonly designed with screens in mind, you may want to create styles that target special devices such as printers or audio-based screenreaders. For example, this CSS targets printers:

`@media print { … }`

We can also target multiple devices. For instance, this @mediarule uses two media queries to target both screen and print devices:

`@media screen, print { … }`


Many media features are range features prefixed with “min-“ or “max-“ to express “minimum condition” or “maximum condition” constraints.

For example, to apply CSS to devices with max viewport width of 1200px we can use

`@media (max-width: 1200px) { … }`

A list of commonly used media queries to target specific device sizes.

```

// Small devices (landscape phones, 576px and up)
@media (min-width: 576px) { ... }

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) { ... }

// Large devices (desktops, 992px and up)
@media (min-width: 992px) { ... }

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) { ... }

```


### Normalizing CSS

All browsers have a basic set of CSS rules for styling HTML pages, our custom CSS sits on the top of the browser’s CSS. Since, all browsers have a slightly different implementation of their CSS, to provide the user with a consistent experience across all browsers we need to normalize or override the browser’s CSS.

[Normalize.css](http://necolas.github.io/normalize.css) is the most commonly used solution for this problem.  Normalize.css makes browsers render all elements more consistently and in line with modern standards. It precisely targets only the styles that need normalizing.

You must load the normalizing CSS file before any other CSS.


*THIS WAS AN EXCERPT TAKEN FROM A WEB DEVELOPMENT BOOTCAMP I TAUGHT. EVERYTHING IN THE ARTICLE IS MOSTLY UNEDITED AND NOT DESIGNED FOR THIS BLOG YET.*

---

# Intro to JS

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


---

# Intro to PHP

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

---

# Intro to MySQL


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


