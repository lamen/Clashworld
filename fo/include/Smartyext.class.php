<?php

	require_once(dirname(__FILE__).'/smarty-3.1.8/libs/Smarty.class.php');
	
	class Smartyext extends Smarty{
  
		function __construct(){
		
			parent::__construct();
			
			$this->setTemplateDir(dirname(dirname(__FILE__)).'/smarty/templates')
				->setCompileDir(dirname(dirname(__FILE__)).'/smarty/templates_c')
				->setCacheDir(dirname(dirname(__FILE__)).'/smarty/cache');
		
		}
  
	}
  
  
?>