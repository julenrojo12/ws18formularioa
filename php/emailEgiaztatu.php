<?php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
$emaitza = $soapclient->call('egiaztatuE',array('x'=>$_POST['email']));
echo '<h4>WS-n matrikulatuta dago? ' . $soapclient->call('egiaztatuE',array('x'=>$_POST['email'])). '</h4>';
if ($emaitza == 'BAI'){
	echo "<script type='text/javascript'>document.getElementById('bidali').disabled = false;</script>";
}else{
	echo "<script type='text/javascript'>document.getElementById('bidali').disabled = true;</script>";
}
		//echo '<h2>Request</h2><pre>'.htmlspecialchars($soapclient->request, ENT_QUOTES).'</pre>';
		//1echo '<h2>Response</h2><pre>'.htmlspecialchars($soapclient->response,ENT_QUOTES).'</pre>';
		//echo '<h2>Debug</h2>';
		//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
?>