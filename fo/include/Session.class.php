<?php

  class Session{

    function __construct(){
	    $this->_oLoad = new Loader();
	    $this->_oLog = $this->_oLoad->load('Log');
	    $this->_oLog->addLog('Info','sessionStart');
      session_start();
    }

    public function addToSession($sKey,$sValue){
      $_SESSION[$sKey]=$sValue;
    }

    public function getFromSession($sKey){
      return($_SESSION[$sKey]);
    }

    public function clearSession(){
	    $this->_oLog = $this->_oLoad->load('Log');
	    $this->_oLog->addLog('Info','clearSession');
	session_unset();    
	return(session_destroy());
    }

  }

?>
