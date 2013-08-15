<?php

/**
*	@desc Sql Class
*	@author romain dumont
*/

require_once("Mysql.class.php");

	class Sql{

		private $_oSqli;
		private $_oLoad;

		function __construct(){
			$this->_oLoad = new Loader();
			$this->_oSqli = $this->_oLoad->load('Mysql');
		}

		public function callStoPro($sProcName,$aParam){
				$this->_oSqli->executeStoPro($sProcName,$aParam);
			
		}

		public function getNextValueByArray($iFetch=TRUE){
			if($iFetch) return($this->_oSqli->getArrayAfterFetch());
			else return($this->_oSqli->getArray());
		}

		public function getValueByName($sName,$iFetch=TRUE){
			if($iFetch) return($this->_oSqli->getAfterFetch($sName));
			else return($this->_oSqli->get($sName));
		}

		public function fetch(){
			return($this->_oSqli->fetch());
		}

		//return result in an array, 
		//if bDimension = false :
		//array(line1res1,line1res2,line2res1,line2res2...)
		//else
		//array(0=>line1res1,line1res2
		//	1=>line2res1,line2res2)
		public function getArrayResult($bReference=false,$bDimension=true){
		
			$aResult=array();
			$aResultDim=array();
			$aColumnName=array();

			$aColumnName=$this->_oSqli->getColumnName();

			if($bDimension===true){
			
				while($this->fetch()){
					for($iI=0;$iI<count($aColumnName);$iI++){
						if($bReference===false) array_push($aResultDim,$this->getValueByName($aColumnName[$iI],false));
						else $aResultDim[$aColumnName[$iI]]=$this->getValueByName($aColumnName[$iI],false);
					}

				$aResult[]=$aResultDim;
				$aResultDim=array();

				}
				
			
			}else{
			
				while($this->fetch()){
					for($iI=0;$iI<count($aColumnName);$iI++){
						if($bReference===false) array_push($aResult,$this->getValueByName($aColumnName[$iI],false));
						else $aResult[$aColumnName[$iI]]=$this->getValueByName($aColumnName[$iI],false);
					}
				}
			
			}

			return($aResult);
		}


	}

?>
