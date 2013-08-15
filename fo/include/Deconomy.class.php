<?php

require_once('Data.class.php');

/**
*	@desc Data economy
*	@author romain dumont
*/

	class Deconomy extends Data{

		//return the resources stats
		public function getResourcesStats($bDim,$bRef){

			return($this->getArrayData('get_resources_stats',array(1=>$this->_iIdUser),$bDim,$bRef));

		}

	}

?>