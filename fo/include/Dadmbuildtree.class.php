<?php

require_once('Data.class.php');

/**
*	@desc Data admbuildtree
*	@author romain dumont
*/

	class Dadmbuildtree extends Data{
	
		//return the libelle for the select build
		public function getSelectFactionLibelle($bDim,$bRef){

			return($this->getArrayData('get_faction',null,$bDim,$bRef));

		}

		public function getBuildTree($iIdFaction,$bDim,$bRef){
			
			return($this->getArrayData('get_build_by_idfaction',array(1=>$iIdFaction),$bDim,$bRef));

		}

	}	
?>
