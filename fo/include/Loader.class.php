<?php

/**
*	@desc Loader Class
*	@author romain dumont
*/

class loader{

  //-- path to the directory include
  public $sPathRoot;
  static $sPathInclude = array();
  
  function __construct(){
  
    //-- path of the root directory
    $this->sPathRoot = dirname(dirname(__FILE__));
    //-- complete path root to the include directory
    $this->sPathInclude[] = $this->sPathRoot.'/include';
    $this->sPathInclude[] = $this->sPathRoot.'/include/smarty-3.1.8/libs';
    
    //-- add to include path the directory include
    for($iI=0;$iI<count($this->sPathInclude);$iI++){
      if(!strstr(get_include_path(),$this->sPathInclude[$iI]))set_include_path(get_include_path() . PATH_SEPARATOR . $this->sPathInclude[$iI]);
    }
  }

  public function load($sObjToLoad,$aParam=''){
    
    $sObjToLoadPath = $sObjToLoad.'.class.php';
    $oObjLoaded=null;
    
    for($iI=0;$iI<count($this->sPathInclude);$iI++){
      if(file_exists($this->sPathInclude[$iI].'/'.$sObjToLoadPath)){
	require_once($sObjToLoadPath);
	$oObjLoaded = new $sObjToLoad($aParam);
	//return the new object, expect if the loaded object return an object
	if(method_exists($oObjLoaded,'getObject')) return $oObjLoaded->getObject();
	else return $oObjLoaded;
      }
    }

    return(FALSE);
  }


}


?>
