<?php

/**
*	@desc View Login
*	@author romain dumont
*/

  class Vlogin{

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
	  
	  $slang = $this->_oSession->getFromSession('lang');

	  $this->_oSmarty->assign('mail', $this->_oLanguage->mail->$slang);
	  $this->_oSmarty->assign('pass', $this->_oLanguage->pass->$slang);
	}

	public function callBackLoginCheck($sEmailAddress,$sPassword){
var_dump('pouet');
	  $aReturn = array();
	  $slang = $this->_oSession->getFromSession('lang');
	  
	  //new sql object
	  $oSql = $this->_oLoad->load('Sql');
	  //call stored procedure to verify the email/password couple
	  $oSql->callStoPro('is_user_registred',array(1=>$sEmailAddress,2=>md5($sPassword)));
	  //return the id user to the browser for the redirection
	  $iUserId=$oSql->getValueByName('iduser');
	  if($iUserId>0){
	    //set the session variable with the user's informations
	    $this->_oSession->addToSession('userid',$iUserId);
	    $this->_oSession->addToSession('email',$sEmailAddress);
	    $this->_oSession->addToSession('pass',md5($sPassword));
	    $aReturn['returntype']='ok';
	    $aReturn['userid']=$iUserId;
	  }else{
	    $aReturn['returntype']='ko';
	    $aReturn['message']=$this->_oLanguage->errcon->$slang;
	  }
	  //response json
	  $oJsonResponse = $this->_oLoad->load('Jsonresponse');
	  $oJsonResponse->response($aReturn);
	  
	}

	public function displayView(){
	  $this->_oSmarty->display('login.tpl');
	}

  }


?>
