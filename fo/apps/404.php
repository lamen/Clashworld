<?php

header("Status: 404 Not Found");

/**
*	@desc 404 Controller
*	@author romain dumont
*/

require_once("../include/Controller.class.php");
$oController = new Controller('404');
$oController->displayAllView();

?>