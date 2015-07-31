<?php 


require dirname(__FILE__).'/RemitaFactory.php';


$remita = new RemitaFactory();

$process = $remita->Process($_POST);

print $process;