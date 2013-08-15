<?php

  require_once('./Loader.class.php');

  class Callbackcontroller{

    private $_aPost;

    function __construct($aPost){

      $this->_aPost = $aPost;
      $this->oLoad = new Loader();
      $oSession = $this->oLoad->load('Session');
      $this->_callBack();
      
    }

    private function _callBack(){

      $aParams = null;

      //load object for the callback
      $oObjectToCall = $this->oLoad->load($this->_aPost['objectToCall']);

      //set param array
      foreach ($this->_aPost as $key => $value){
	if(strpos($key,'_param_')===0) $aParams[str_replace('_param_','',$key)] = $value;
      }
      //call method
      call_user_func_array( array($oObjectToCall,$this->_aPost['methodToCall']), $aParams );

    }

  }

  $oCallBackController = new callbackcontroller($_POST);

?>