<?php

/**
*	@desc View ChooseFaction
*	@author romain dumont
*/

  class Vchoosefaction{

	private $_oLoad;
	private $_oSmarty;
	private $_oSession;
	private $_oLanguage;
  
	function __construct(){
	  $this->_oLoad = new Loader();
	  //session
	  $this->_oSession = $this->_oLoad->load('Session');
	  //language
	  $this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'choosefaction'));
	  //smarty
	  $this->_oSmarty = $this->_oLoad->load('Smartyext');
	  //load the view
	  $this->_loadView();
	}
	
	private function _loadView(){
	  $slang = $this->_oSession->getFromSession('lang');
	}

	public function displayView(){
	  $this->_oSmarty->display('choosefaction.tpl');
	}

  }


?>
