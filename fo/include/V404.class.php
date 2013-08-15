<?php

/**
*	@desc View 404
*	@author romain dumont
*/

	class V404{

		private $_oLoad;
		private $_oSmarty;
		private $_oSession;
		private $_oLanguage;

		function __construct(){
		  $this->_oLoad = new Loader();
		  //session
		  $this->_oSession = $this->_oLoad->load('Session');
		  //language
		  $this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'404'));
		  //smarty
		  $this->_oSmarty = $this->_oLoad->load('Smartyext');
		  //load the view
		  $this->_loadView();
		}

		private function _loadView(){

			$slang = $this->_oSession->getFromSession('lang');

			//build stats
			$this->_oSmarty->assign('m404',$this->_oLanguage->m404->$slang);
		}

		public function displayView(){
		  $this->_oSmarty->display('404.tpl');
		}

	}


?>