<?php
	class Jsonfilereader{

	private $_sTradFile;
	private $_sFileName;
	private $_oJson;

		function __construct($aParams){
			extract($aParams);
			$this->_sFileName = $sFileName;
			$this->_getFile();
			$this->_jsonDecode();
		}

		private function _getFile(){
			$this->_sTradFile = file_get_contents(dirname(dirname(__FILE__))."/include/filesconf/".$this->_sFileName.".json");
		}

		private function _jsonDecode(){
			$this->_oJson=json_decode($this->_sTradFile);
		}

		public function getObject(){
			return($this->_oJson);
		}

	}
?>