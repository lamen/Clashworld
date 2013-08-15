<?php

require_once('Data.class.php');

/**
*	@desc Data city
*	@author romain dumont
*/

	class Dcity extends Data{

		//return the population stats
		public function getSelectCityLibelle($bDim,$bRef){

			return($this->getArrayData('get_city_libelle',array(1=>$this->_iIdUser),$bDim,$bRef));

		}

	}
?>