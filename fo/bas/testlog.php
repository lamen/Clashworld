<?php
//var_dump($_SERVER);die();
require_once(dirname(dirname(__FILE__))."/include/Log.class.php");

$oLog = new Log();
$oLog->addLog('Error','test message E');
$oLog->addLog('Warning','test message W');
$oLog->addLog('Notice','test message N');
$oLog->addLog('Info','test message 
info plusieurs lignes
aaa');

?>