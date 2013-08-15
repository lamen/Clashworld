<?php

require_once(dirname(dirname(__FILE__))."/include/loader.php");
$oLoad = new loader;
if($oSmarty=$oLoad->load('Smarty')){

$oSmarty->setTemplateDir(dirname(dirname(__FILE__)).'/smarty/templates')
       ->setCompileDir(dirname(dirname(__FILE__)).'/smarty/templates_c')
       ->setCacheDir(dirname(dirname(__FILE__)).'/smarty/cache');

$oSmarty->assign('hello_world', 'Bonjour le monde');

$oSmarty->display('test.tpl');

}else echo 'creation impossible';




?>