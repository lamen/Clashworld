<?php

require_once('Data.class.php');

/**
*	@desc Data build
*	@author romain dumont
*/

	class Dbuild extends Data{

		//return the population stats
		public function getBuildStats($bDim,$bRef){

			return($this->getArrayData('get_builds_stats',array(1=>$this->_iIdUser),$bDim,$bRef));

		}

		//return the libelle for the select build
		public function getSelectBuildLibelle($bDim,$bRef){

			return($this->getArrayData('get_build_libelle_by_iduser',array(1=>$this->_iIdUser),$bDim,$bRef));

		}

		//return the timeline data
		public function getUnitTimeline($bDim,$bRef){

			return($this->getArrayData('get_timeline',array(1=>$this->_iIdUser,2=>0),$bDim,$bRef));

		}

		//convert a timestamp to a number of day, minutes, secondes
		public function getConvertedSecond($iNbSecond,$sNegativeResponse){

			return($this->convertSecond($iNbSecond,$sNegativeResponse));

		}

		//Javascript call back for the form button id -> SubButtonAddBuild
		public function callBackAddBuild($iIdBuild,$iIdCity,$iNumber){

			//language
			$oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'build'));

			$aReturn = array();
			$iLastId = null;
			$slang = $this->_oSession->getFromSession('lang');
			
			//new sql object
			$oSql = $this->_oLoad->load('Sql');
			//call stored procedure to verify the email/password couple
			$oSql->callStoPro('create_unit',array(1=>$iIdBuild,2=>$iIdCity,3=>$iNumber));
			//return the lastid
			$iLastId=$oSql->getValueByName('lastid');
			if($iLastId>0){
				$aReturn['returntype']='ok';
				$aReturn['lastid']=$iLastId;
			}else{
				$aReturn['returntype']='ko';
				$aReturn['message']=$oLanguage->noresource->$slang;
			}
			//response json
			$oJsonResponse = $this->_oLoad->load('Jsonresponse');
			$oJsonResponse->response($aReturn);

		}

		public function updateFinishedStatus($iIdUser,$iWhatProduct){
			$oSql = $this->_oLoad->load('Sql');
			$oSql->callStoPro('update_finished_status',array(1=>$iIdUser,2=>$iWhatProduct));
		}


	}
?>
