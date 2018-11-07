<?php
	$xslDoc = new DOMDocument();
	$xslDoc->load("../xml/questions.xsl");
	$xmlDoc = new DOMDocument();
	$xmlDoc->load("../xml/questionsTransAuto.xml");
	$proc = new XSLTProcessor();
	$proc->importStylesheet($xslDoc);
	echo "$proc->transformToXML($xmlDoc)";
?>