<?php

/**
*	@desc View Register
*	@author romain dumont
*/

class Vadmbuildtree{

	function __construct(){
		$this->_oLoad = new Loader();
		//session
		$this->_oSession = $this->_oLoad->load('Session');
		//language
		$this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'admbuildtree'));
		//smarty
		$this->_oSmarty = $this->_oLoad->load('Smartyext');
		//Data admtreebuild
		$this->_oDadmbuildtree = $this->_oLoad->load('Dadmbuildtree');
		//load the view
		$this->_loadView();
	}
  
	private function _loadView(){
	
		$slang = $this->_oSession->getFromSession('lang');

		//faction select
		$this->_oSmarty->assign('select',$this->_oLanguage->select->$slang);
		$this->_oSmarty->assign('aSelectFactionLibelle',$this->_oDadmbuildtree->getSelectFactionLibelle(true,true));
		//--
	}

        public function callBackGetBuildArray($iIdFaction){

		var_dump($this->_oDadmbuildtree->getBuildTree($iIdFaction,true,true));


        }


	
	public function displayView(){
		$this->_oSmarty->display('admbuildtree.tpl');
	}
	
}

?>
