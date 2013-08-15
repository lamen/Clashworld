<?php

/**
*	@desc View header
*	@author romain dumont
*/

	class Vheader{

		private $_oSession;
		private $_oSmarty;
		private $_oLoad;
		private $_oDheader;
	
		function __construct($aParams){
			$this->_oLoad = new Loader();

			//Data header
			$this->_oDheader = $this->_oLoad->load('Dheader');
			extract($aParams);
			$this->_oDheader->setPageName($sPageName);

			//smarty
			$this->_oSmarty = $this->_oLoad->load('Smartyext');

			//session
			$this->_oSession = $this->_oLoad->load('Session');

			//language
			$this->_oLanguage = $this->_oLoad->load('Language');

			//set Params
			$this->_oDheader->setParam('js');
			$this->_oDheader->setParam('css');
			$this->_oDheader->setParam('lang');
			$this->_oDheader->setParam('connected');

			//lang
			$this->_oDheader->setLang();

			//if user is not connected -> login page
			if($this->_oDheader->userIsConnected()){
				$this->_loadView();
			}else{
				header("Location: http://".$_SERVER['HTTP_HOST']."/login");
			}
		}

		private function _loadView(){

			$slang = $this->_oSession->getFromSession('lang');
//var_dump($slang);
			$this->_oSmarty->assign('jsfile', $this->_oDheader->loadJs());
			$this->_oSmarty->assign('cssfile', $this->_oDheader->loadCss());
			$this->_oSmarty->assign('IsConNeeded', $this->_oDheader->isConNeeded);
			$this->_oSmarty->assign('urlregister', 'register');
			$this->_oSmarty->assign('registertxt', $this->_oLanguage->registertxt->$slang);
		}

		public function displayView(){
			$this->_oSmarty->display('header.tpl');
		}

	}
?>
