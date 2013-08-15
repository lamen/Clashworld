<?php

/**
 * @desc View Login
 * @author romain dumont
 * 
**/

class Vcity{
	
	private $_oLoad;
	private $_oSmarty;
	private $_oSession;
	private $_oLanguage;
	
	function __construct(){
		$this->_oLoad = new Loader();
		//session
		$this->_oSession = $this->_oLoad->load('Session');
		//language
		$this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'login'));
		//smarty
		$this->_oSmarty = $this->_oLoad->load('Smartyext');
		//load the view
		$this->_loadView();
	}
	
	private function _loadView(){
	}

	//return the population stats
	
	private function _getPopulationStats(){
	}
	
	public function displayView(){
		$this->_oSmarty->display('city.tpl');
	}

}

?>
