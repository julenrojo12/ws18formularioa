<!-- PASAHITZA BEZEROA -->
<?php
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	//HODEIEAN:
	$soapclient2 = new nusoap_client('https://ws834621.000webhostapp.com/?dir=Formularioa/php/egiaztatuPasahitza.php?wsdl', true);
	//LOKALEAN:
	//$soapclient2 = new nusoap_client('http://localhost/wsae/ik18/php/egiaztatuPasahitza.php?wsdl', true);
	$emaitza2 = $soapclient2->call('balioztatu',array('x'=>$_POST['pasahitza'],'y'=>1010));
	echo '<h4>Pasahitza egokia da? ' .$soapclient2->call('balioztatu',array('x'=>$_POST['pasahitza'],'y'=>1010)). '</h4>';
	if ($emaitza2 == 'BALIOZKOA'){
	echo "<script type='text/javascript'>document.getElementById('bidali').disabled = false;</script>";
	}else{
	echo "<script type='text/javascript'>document.getElementById('bidali').disabled = true;</script>";
}
	//echo '<h2>Request</h2><pre>'.htmlspecialchars($soapclient->request, ENT_QUOTES).'</pre>';
	//echo '<h2>Response</h2><pre>'.htmlspecialchars($soapclient->response,ENT_QUOTES).'</pre>';
	//echo '<h2>Debug</h2>';
?>
