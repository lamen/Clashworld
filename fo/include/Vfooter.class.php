<?php

  class Vfooter{
  
    private $_sPageName;

    function __construct($aParams){
	 
      extract($aParams);
      $this->_sPageName = $sPageName;
      $this->_oLoad = new Loader();

      //set Params
      $this->_setParam('js');

      //smarty
      $this->_oSmarty = $this->_oLoad->load('Smartyext');
	  
      $this->_loadView();
    }

    private function _loadView(){
	  $this->_oSmarty->assign('jsfile', $this->_loadJs());
	  $this->_oSmarty->assign('uri', $_SERVER['SCRIPT_URI']);
    }

    private function _setParam($sType){
      
      //Sql
      $oSql = $this->_oLoad->load('Sql');

      //Get params from database
      $oSql->callStoPro('get_param_by_type',array(1=>$sType));

      //Set _aParams
      while($oSql->fetch()){
                $aTmp = $oSql->getNextValueByArray(FALSE);
                //only one dimension
                if($this->_aParams[$sType][$aTmp['pkey']] == '') $this->_aParams[$sType][$aTmp['pkey']] = $aTmp['pvalue'];
                //add second dimension if needed
                else{
                  if(!is_array($this->_aParams[$sType][$aTmp['pkey']])){
                        $this->_aParams[$sType][$aTmp['pkey']] = array($this->_aParams[$sType][$aTmp['pkey']],$aTmp['pvalue']);
                  }else $this->_aParams[$sType][$aTmp['pkey']][] = $aTmp['pvalue'];
                }
      }

    }


    private function _loadJs(){
      
     $aJsList=array();
     if($this->_aParams['js'][$this->_sPageName] != ''){ 
       if(is_array($this->_aParams['js'][$this->_sPageName])){

         for($iI=0;$iI < count($this->_aParams['js'][$this->_sPageName]);$iI++){
          $aJsList[]=$this->_aParams['js'][$this->_sPageName][$iI];
         }
                
        }else $aJsList[]=$this->_aParams['js'][$this->_sPageName];
      }   
	return($aJsList); 
    }


    public function displayView(){
      $this->_oSmarty->display('footer.tpl');
    }

  }

?>
