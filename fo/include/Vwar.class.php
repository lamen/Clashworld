<?php

/**
*	@desc View war
*	@author romain dumont
*/

	class Vwar{

		private $_oLoad;
		private $_oSmarty;
		private $_oSession;
		private $_oLanguage;

		function __construct(){
		  $this->_oLoad = new Loader();
		  //session
		  $this->_oSession = $this->_oLoad->load('Session');
		  //language
		  $this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'war'));
		  //smarty
		  $this->_oSmarty = $this->_oLoad->load('Smartyext');
		  //Data build
		  $this->_oDwar = $this->_oLoad->load('Dwar');
		  //load the view
		  $this->_loadView();
		}

		private function _loadView(){

			$slang = $this->_oSession->getFromSession('lang');

			//War stats
			$this->_oSmarty->assign('aWarStats',$this->_oDwar->getWarStats(false,false));
			$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
			$this->_oSmarty->assign('libellegender',$this->_oLanguage->libellegender->$slang);
			$this->_oSmarty->assign('number',$this->_oLanguage->number->$slang);
			$this->_oSmarty->assign('level',$this->_oLanguage->level->$slang);
			$this->_oSmarty->assign('attack',$this->_oLanguage->attack->$slang);
			$this->_oSmarty->assign('specialattack',$this->_oLanguage->specialattack->$slang);
			$this->_oSmarty->assign('defense',$this->_oLanguage->defense->$slang);
			$this->_oSmarty->assign('specialdefense',$this->_oLanguage->specialdefense->$slang);
			$this->_oSmarty->assign('carry',$this->_oLanguage->carry->$slang);

		}


		public function displayView(){
		  $this->_oSmarty->display('war.tpl');
		}

	}


?>