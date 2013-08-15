<?php
/**
*	@desc Login Controller
*	@author romain dumont
*/
try{
 require_once("../include/Controller.class.php");
 
 $oController = new Controller('login');
 $oController->displayAllView();
}
catch(Exception $e){
 echo $e->getMessage();
}
?>
