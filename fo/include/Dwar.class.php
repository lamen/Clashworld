<?php

require_once('Data.class.php');

/**
*	@desc Data war
*	@author romain dumont
*/

	class Dwar extends Data{

		//return the population stats
		public function getWarStats($bDim,$bRef){

			return($this->getArrayData('get_war_stats',array(1=>$this->_iIdUser),$bDim,$bRef));

		}

	}

?>