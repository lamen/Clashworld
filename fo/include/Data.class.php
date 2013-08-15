<?php

/**
*	@desc Data
*	@author romain dumont
*/

	class Data{

		protected $_oLoad;
		protected $_oSession;
		protected $_iIdUser;

		function __construct(){
		  $this->_oLoad = new Loader();
		  //session
		  $this->_oSession = $this->_oLoad->load('Session');
		  $this->_iIdUser = $this->_oSession->getFromSession('userid');
		}

		protected function getArrayData($sStoProName,$aStoProParam,$bArrayDimResult,$bReferenceResult){
		
			$aResult=array();

			//new sql object
			$oSql = $this->_oLoad->load('Sql');

			//call stored procedure to get resources statistics
			$oSql->callStoPro($sStoProName,$aStoProParam);
			$aResult=$oSql->getArrayResult($bReferenceResult,$bArrayDimResult);

			unset($oSql);
			return($aResult);
		
		}

		protected function convertSecond($iTime,$sNegativeResponse=false) {

			if($iTime<0) return($sNegativeResponse);
			else{
				$aTabTemps = array("jours" => 86400,"h" => 3600,"m" => 60,"s" => 1);

				$sResult = "";

				foreach($aTabTemps as $uniteTemps => $nombreSecondesDansUnite) {
					$$uniteTemps = floor($iTime/$nombreSecondesDansUnite);

					$iTime = $iTime%$nombreSecondesDansUnite;

					if($$uniteTemps > 0 || !empty($sResult)) $sResult .= $$uniteTemps."$uniteTemps ";
				}
				return $sResult;
			}
		}

	}
?>