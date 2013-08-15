<?php

require_once('Data.class.php');

/**
*	@desc Data build
*	@author romain dumont
*/

	class Dheader extends Data{

		private $_sPageName;
		public $isConNeeded;

		//@todo replace with superseter in data object
		public function setPageName($sPageName){
			$this->_sPageName=$sPageName;
		}

		//Javascript call back for logout button
		public function callBackLogOut(){
			$this->_oLog = $this->_oLoad->load('Log');
			$this->_oLog->addLog('Info','Vheader::callBackLogOut');
			if($this->_oSession->clearSession()){
				$aReturn['returntype']='ok';
				$this->_oLog->addLog('Info','Vheader::callBackLogOutOk');
			}else{
				$aReturn['returntype']='ko';
				$this->_oLog->addLog('Info','Vheader::callBackLogOutKo');
			}
			//response json
			$oJsonResponse = $this->_oLoad->load('Jsonresponse');
			$oJsonResponse->response($aReturn);
		}


		public function loadJs(){

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
	    
		public function loadCss(){

			$aCssList=array();
			if($this->_aParams['css'][$this->_sPageName] != ''){
				if(is_array($this->_aParams['css'][$this->_sPageName])){

					for($iI=0;$iI < count($this->_aParams['css'][$this->_sPageName]);$iI++){
						$aCssList[]=$this->_aParams['css'][$this->_sPageName][$iI];
					}

				}else{
					$aCssList[]=$this->_aParams['css'][$this->_sPageName];
				}
			}
			return($aCssList);
		}

		public function setParam($sType){
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

		public function userIsConnected(){

			if($this->_aParams['connected'][$this->_sPageName]==1){//connection needed

				if($this->_oSession->getFromSession('userid') != ''){
					$oSql = $this->_oLoad->load('Sql');
					//Get the user id with the email and pass
					$oSql->callStoPro('is_user_registred',array(1=>$this->_oSession->getFromSession('email'),2=>$this->_oSession->getFromSession('pass')));
					//If the user id in session is different that the id getting before -> return false
					if($this->_oSession->getFromSession('userid') === $oSql->getValueByName('iduser')) return(TRUE);
					else return(FALSE);
				}else{
					$this->isConNeeded=0;
					return(FALSE);
				}

			}else{//no connection needed
				$this->isConNeeded=1;
				return(TRUE);
			}

		}

		public function setLang(){
			//set the language by the url extension, if the extension is not set use the default language
			if(array_key_exists($_SERVER['HTTP_HOST'],$this->_aParams['lang'])){
				$this->_sLang = $this->_aParams['lang'][$_SERVER['HTTP_HOST']];
			}else $this->_sLang = $this->_aParams['lang']['default'];
			$this->_oSession->addToSession('lang',$this->_sLang);
		}
	}
?>
