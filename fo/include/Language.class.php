<?php

	class Language{

		private $_oLoad;
		private $_oJsonfilereader;
    
		function __construct($aParams){
			$this->_oLoad = new Loader();
                        $this->_oJsonfilereader=$this->_oLoad->load('Jsonfilereader',array('sFileName'=>'data.trad'));

		}

               public function getObject(){
			return($this->_oJsonfilereader);
               }
	}

?>
