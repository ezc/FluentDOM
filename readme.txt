--------------------------------------------------------------------------------
 FluentDOM
 
 Version: 4 dev
 Copyright: 2009-2011 Bastian Feder, Thomas Weinert
 Licence: The MIT License
          http://www.opensource.org/licenses/mit-license.php
--------------------------------------------------------------------------------

FluentDOM provides an easy to use fluent interface for DOMDocument. We tried to
keep the jQuery API but adapted iweweqt to PHP and the server environment.

The idea was born in a workshop of Tobias Schlitt (http://schlitt.info) about
the PHP XML extensions at the IPC Spring in Berlin. He used this idea to show
XPath samples in the session. Since then he contributed several ideas and hints.
The loader concept was his idea, too.

FluentDOM is a test driven project. We write tests before and during the
development. You will find the PHPUnit test in the "tests" subdirectory.

--------------------------------------------------------------------------------

Table Of Contents:
* URLs
* Requirements
* Usage
* Similarities With jQuery
* Differences To jQuery
* Classes
* Syntax Sugar
* Loaders

--------------------------------------------------------------------------------
 URLs
--------------------------------------------------------------------------------

Website: http://fluentdom.org

--------------------------------------------------------------------------------
 Requirements
--------------------------------------------------------------------------------

1) PHP >= 5.2 

FluentDOM needs at least PHP 5.2 but PHP 5.3 is suggested. Closures are
supported.

--------------------------------------------------------------------------------
 Usage
--------------------------------------------------------------------------------

echo FluentDOM('sample.xml')
  ->find('//h1[@id = "title"]')
  ->text('Hello World!');
  
The sample create a new FluentDOM object, loads the sample.xml file, looks for
an tag <h1> with the attribute "id" that has the value "title", sets the
content of this tag to "Hello World" and outputs the manipulated document.

--------------------------------------------------------------------------------
 Similarities With jQuery
--------------------------------------------------------------------------------

FluentDOM was created after the jQuery API and concepts. You will notice that
the most method names and parameters are the same.

Many thanks to the jQuery (jquery.com) people for their work, who did an
exceptional job describing their interfaces and providing examples. This saved
us a lot of work. We implemented most of the jQuery methods into FluentDOM

To be able to write PHPUnit Tests and develop FluentDOM a lot of examples where
written. Most of them are copied and adapted from or are deeply inspired by the
jQuery documentation. They are located in the 'examples' folder. 
Once again many thanks to the jQuery team.

--------------------------------------------------------------------------------
 Major Differences To jQuery
--------------------------------------------------------------------------------

1) XPath selectors

Every method that supports a selector uses XPath not CSS selectors. Since XPath
is supported by the ext/xml extension, no extra parsing need to be
done. This should be faster processing the selectors and btw it was easier for
us to implement. And as a nice topping it supports namespaces, too.

2) Text nodes

With a few exceptions FluentDOM handles text nodes just like element nodes.
You can select, traverse and manipulate them.

3) FluentDOM(), FluentDOMStyle()

Functions creating an object of the same class with the same name. You can
provide $source and $contentType parameters to initialize the content.
Makes the chaining nicer. 

$fd = FluentDOM($source)->find($selector);

4) FluentDOM::xml()

A method to read and write the inner XML of the selected nodes. Complement of 
jQuery's html() method.

--------------------------------------------------------------------------------
 Classes
--------------------------------------------------------------------------------

* FluentDOM

The main class. Supports most of jQuerys selection, traversing and manipulation
methods.

* FluentDOMStyle

Extends FluentDOM with support for manipulation of the style attribute.

* FluentDOMCore

The base class containing the core functions.

* FluentDOMHelper

A helper class containing static callbacks used by the other classes

* FluentDOMIterator

Iterator for FluentDOM objects. Used for syntax sugar.

* FluentDOMLoader

Interface for loader classes. They are used to import document content from
all kinds of sources.

* FluentDOMAttributes

Provides the attributes handling.

* FluentDOMCss

Provides the 'style' atrribute handling

* FluentDOMCssProperties

Provides decode/encoding for a style attribute value. Allows to manipulate the 
css properties.

* FluentDOMData

Provide array access to the HTML 5 data attributes.

--------------------------------------------------------------------------------
 Syntax Sugar
--------------------------------------------------------------------------------

FluentDOM supports a lot of PHP's syntax sugar implementing interfaces.
You can traverse selected elements using "foreach($fd as $node)", access them
with "$fd[$i]" syntax or use "count($fd)".

We support the string conversion using the magic __toString() method. It will
output the xml (or html) of the associated DOMDocument.

FluentDOM has two methods namespaces() and evaluate(), that can be sued to do
direct xpath queries.

For the attribute handling array syntax is supported. You can use $fd->attr,
$fd->data and $fd->css.

--------------------------------------------------------------------------------
 Loaders
--------------------------------------------------------------------------------

FluentDOM uses loader classes to import document content. If you do not set
an own loader object it initializes a default list of loader objects. They
provide support for the usual stuff like XML and HTML files and strings.
