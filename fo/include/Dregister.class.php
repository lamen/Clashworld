<?php

require_once('Data.class.php');

/**
*	@desc Data build
*	@author romain dumont
*/

	class Dregister extends Data{
	
		//return the libelle for the select build
		public function getSelectFactionLibelle($bDim,$bRef){

			return($this->getArrayData('get_faction',null,$bDim,$bRef));

		}

		public function callBackRegisterCheck($sEmail,$sPassword,$sConfirmPassword,$sPseudo,$sRecaptchaChallengeField,$sRecaptchaResponseField,$sFaction){

			$aReturn = array();
			$slang = $this->_oSession->getFromSession('lang');

			//language
			$oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'register'));

			//Check if all input is setted
			if(empty($sEmail)||empty($sPassword)||empty($sConfirmPassword)||empty($sPseudo)||empty($sRecaptchaResponseField)){
			      $aReturn['returntype']='ko';
			      $aReturn['message']=$oLanguage->empty_input->$slang;

			//Check if email is valid
			}elseif($this->_isValidEmail($sEmail)===false || $this->_isValidEmail($sEmail)==0){

				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->not_valid_email->$slang;

			//Check if the password and confirmpassword are the same
			}elseif($sConfirmPassword!=$sPassword){

				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->pass_not_egal->$slang;

			//Check if the Captcha is correct
			}elseif($this->_checkCaptcha($sRecaptchaChallengeField,$sRecaptchaResponseField)===false){

				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->captcha_error->$slang;
			      
			//Check if the email is not already setted
			}elseif($this->_isUserEmailAlreadyRegister($sEmail)===false){

				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->user_email_already_register->$slang;
			      
			//Check if the login is not already setted
			}elseif($this->_isUserLoginAlreadyRegister($sPseudo)===false){

				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->user_login_already_register->$slang;

			//Create new user
			}else{

				$oSql = $this->_oLoad->load('Sql');
				$oSql->callStoPro('create_user',array(1=>$sFaction,2=>$sEmail,3=>md5($sPassword),4=>$sPseudo));
				//Get new user id
				$iNewUserId=$oSql->getValueByName('lastid');
				unset($oSql);

				//set the session variable with the user's informations
				$this->_oSession->addToSession('userid',$iNewUserId);
				$this->_oSession->addToSession('email',$sEmail);
				$this->_oSession->addToSession('pass',md5($sPassword));
				$aReturn['returntype']='ok';
				$aReturn['userid']=$iNewUserId;
			      
			}

			//json response
			$oJsonResponse = $this->_oLoad->load('Jsonresponse');
			$oJsonResponse->response($aReturn);

		}

		//Check if the captcha is valid
		private function _checkCaptcha($sChallengeField,$sResponseField){
			//reCaptcha
			$oRecaptcha = $this->_oLoad->load('Recaptcha');
			$aReCaptchaResponse = $oRecaptcha->recaptchaCheckAnswer($_SERVER["REMOTE_ADDR"],$sChallengeField,$sResponseField);
			if ($aReCaptchaResponse['is_valid']) return true;
			else return false;
		
		}
		
		//Check if the email is already registred
		private function _isUserEmailAlreadyRegister($sEmail){
			
			//new sql object
			$oSql = $this->_oLoad->load('Sql');
			//call stored procedure to verify if the email already exist
			$oSql->callStoPro('is_user_email_already_exist',array(1=>$sEmail));
			$iUserId=$oSql->getValueByName('iduser');
			if($iUserId>0) return false;
			else return true;
			
		}
		
		//Check if the login is already registred
		private function _isUserLoginAlreadyRegister($sPseudo){
			
			//new sql object
			$oSql = $this->_oLoad->load('Sql');
			//call stored procedure to verify if the login already exist
			$oSql->callStoPro('is_user_login_already_exist',array(1=>$sPseudo));
			$iUserId=$oSql->getValueByName('iduser');
			if($iUserId>0) return false;
			else return true;
			
		}

		//Check if the email format is valid
		private function _isValidEmail($sEmail){
			if(preg_match('/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}/',$sEmail)) return true;
			else return false;
		}
	
	}
	
	
?>