<?php

/**
*	@desc View Register
*	@author romain dumont
*/

class Vregister{
  
	function __construct(){
		$this->_oLoad = new Loader();
		//session
		$this->_oSession = $this->_oLoad->load('Session');
		//language
		$this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'register'));
		//smarty
		$this->_oSmarty = $this->_oLoad->load('Smartyext');
		//Data build
		$this->_oDregister = $this->_oLoad->load('Dregister');
		//load the view
		$this->_loadView();
	}
  
	private function _loadView(){
	
		$slang = $this->_oSession->getFromSession('lang');

		//faction select
		$this->_oSmarty->assign('select',$this->_oLanguage->select->$slang);
		$this->_oSmarty->assign('aSelectFactionLibelle',$this->_oDregister->getSelectFactionLibelle(true,true));
		//--
  
		$this->_oSmarty->assign('pseudo', $this->_oLanguage->pseudo->$slang);
		$this->_oSmarty->assign('confirmpass', $this->_oLanguage->confirmpass->$slang);
		$this->_oSmarty->assign('mail', $this->_oLanguage->mail->$slang);
		$this->_oSmarty->assign('pass', $this->_oLanguage->pass->$slang);
		$this->_oSmarty->assign('registerbutton', $this->_oLanguage->registerbutton->$slang);

	}
	
	public function displayView(){
		$this->_oSmarty->display('register.tpl');
	}
	
}

?>