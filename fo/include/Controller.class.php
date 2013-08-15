<?php

//Loader
require_once("Loader.class.php");

/**
*	@desc Controller
*	@author romain dumont
*/

	class Controller{

		private $_oLoad;
		private $_oHeader;
		private $_oBody;
		private $_oFooter;

		function __construct($sPageName){

			$this->_oLoad = new Loader();
			
			try{$this->_oHeader = $this->_oLoad->load('Vheader',array('sPageName'=>$sPageName));}
			catch(header_view_load_failed  $e){ throw $e;}
		
			try{$this->_oBody = $this->_oLoad->load('V'.$sPageName);}
			catch(page_view_load_failed  $e){ throw $e;}

			try{$this->_oFooter = $this->_oLoad->load('Vfooter',array('sPageName'=>$sPageName));}
			catch(footer_view_load_failed  $e){ throw $e;}
		}

		public function displayAllView(){
			echo $this->_oHeader->displayView();//Header
			echo $this->_oBody->displayView();//Body
			echo $this->_oFooter->displayView();//Footer
		}


	}

?>
