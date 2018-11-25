<?php
	//nusoap.php klasea gehitzen dugu
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	//soap_server motako objektua sortzen dugu
	$ns="https://ws834621.000webhostapp.com/?dir=Formularioa/php/egiaztatuPasahitza.php?wsdl";
	//$ns="http://localhost/wsae/ik18/php/egiaztatuPasahitza.php?wsdl";
	$server = new soap_server;
	$server->configureWSDL('balioztatu',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//inplementatu nahi dugun funtzioa erregistratzen dugu
	//funtzio bat baino gehiago erregistra liteke …
	$server->register('balioztatu',
	array('x'=>'xsd:string', 'y'=>'xsd:int'),
	array('z'=>'xsd:string'),
	$ns);
	//funtzioa inplementatzen da
	function balioztatu($x, $y){
		if($y == 1010){
			if ($file = fopen("../toppasswords.txt", "r")) {
				while(!feof($file)) {
					$line = fgets($file);
					if(trim($line) == $x){
						return "BALIOGABEA";
					}
				}
			}
			fclose($file);
			return "BALIOZKOA";
		}
		return "ZERBITZURIK GABE";
	}
	//nusoap klaseko service metodoari dei egiten diogu, behin parametroak
	// prestatuta daudela
	if (!isset( $HTTP_RAW_POST_DATA )) {
		$HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	}
	$server->service($HTTP_RAW_POST_DATA);
?>