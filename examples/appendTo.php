<?php
/**
*
* @version $Id$
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
* @copyright Copyright (c) 2009 Bastian Feder, Thomas Weinert
*/
header('Content-type: text/plain');

$xml = <<<XML
<html>
<head></head>
<body>
  <span>I have nothing more to say... </span>
  <div id="foo">FOO! </div>
</body>
</html>
XML;

require_once('../src/FluentDOM.php');
echo FluentDOM($xml)
  ->find('//span')
  ->appendTo('//div[@id = "foo"]');
?>