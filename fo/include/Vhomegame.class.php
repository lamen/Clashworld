<?php

/**
*	@desc View Home Game
*	@author romain dumont
*/

  class Vhomegame{
  
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
	  
	  //Economy
	  $this->_oEconomy = $this->_oLoad->load('Deconomy');
	  
	  //Build
	  $this->_oBuild = $this->_oLoad->load('Dbuild');

	  //War
	  $this->_oWar = $this->_oLoad->load('Dwar');
	  
	  //load the view
	  $this->_loadView();
    }
      
    private function _loadView(){

		$slang = $this->_oSession->getFromSession('lang');

		//economy stats
		$this->_oSmarty->assign('aResourcesStats',$this->_oEconomy->getResourcesStats(false,false));
		$this->_oSmarty->assign('food',$this->_oLanguage->food->$slang);
		$this->_oSmarty->assign('wood',$this->_oLanguage->wood->$slang);
		$this->_oSmarty->assign('iron',$this->_oLanguage->iron->$slang);
		$this->_oSmarty->assign('stone',$this->_oLanguage->stone->$slang);
		$this->_oSmarty->assign('gold',$this->_oLanguage->gold->$slang);
		$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
		//--
		
		//build stats
		$this->_oSmarty->assign('aBuildStats',$this->_oBuild->getBuildStats(false,false));
		$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
		$this->_oSmarty->assign('libellebuild',$this->_oLanguage->libellebuild->$slang);
		$this->_oSmarty->assign('number',$this->_oLanguage->number->$slang);
		$this->_oSmarty->assign('buildlevel',$this->_oLanguage->level->$slang);
		$this->_oSmarty->assign('foodproduct',$this->_oLanguage->food->$slang);
		$this->_oSmarty->assign('woodproduct',$this->_oLanguage->wood->$slang);
		$this->_oSmarty->assign('ironproduct',$this->_oLanguage->iron->$slang);
		$this->_oSmarty->assign('stoneproduct',$this->_oLanguage->stone->$slang);
		$this->_oSmarty->assign('goldproduct',$this->_oLanguage->gold->$slang);
		$this->_oSmarty->assign('libelleresearch',$this->_oLanguage->libelleresearch->$slang);
		//--

		//War stats
		$this->_oSmarty->assign('aWarStats',$this->_oWar->getWarStats(false,false));
		//$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
		$this->_oSmarty->assign('libellegender',$this->_oLanguage->libellegender->$slang);
		//$this->_oSmarty->assign('number',$this->_oLanguage->number->$slang);
		$this->_oSmarty->assign('level',$this->_oLanguage->level->$slang);
		$this->_oSmarty->assign('attack',$this->_oLanguage->attack->$slang);
		$this->_oSmarty->assign('specialattack',$this->_oLanguage->specialattack->$slang);
		$this->_oSmarty->assign('defense',$this->_oLanguage->defense->$slang);
		$this->_oSmarty->assign('specialdefense',$this->_oLanguage->specialdefense->$slang);
		$this->_oSmarty->assign('carry',$this->_oLanguage->carry->$slang);
		//--
		
    }

    public function displayView(){
	  $this->_oSmarty->display('homegame.tpl');
    }

  }


?>