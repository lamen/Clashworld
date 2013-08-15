<?php

/**
*       @desc Env Class, for environement gestion
*       @author romain dumont
*/

	class Env{

		public $sEnv;
		private $_oDbEnv;
		private $_oLoad;
		

		function __construct(){
			$this->_oLoad = new Loader();
			if(substr($_SERVER['HTTP_HOST'],0,3)=='dev') $this->sEnv = 'dev';
			elseif($_SERVER['HTTP_HOST']=='localhost') $this->sEnv = 'local';
			else  $this->sEnv = 'prod';
			$this->_setDbEnv();
		}

		//@todo charged only the required configuration not all
		private function _setDbEnv(){
                        $this->_oDbEnv=$this->_oLoad->load('Jsonfilereader',array('sFileName'=>'db.conf'));
		}

		public function getDbEnv($sParam){

			$sEnv=$this->sEnv;
	
			//@todo a factoriser
			switch($sParam){
				case 'address':return($this->_oDbEnv->address->$sEnv);
				case 'login':return($this->_oDbEnv->login->$sEnv);
                        	case 'psw':return($this->_oDbEnv->psw->$sEnv);
                        	case 'dbname':return($this->_oDbEnv->dbname->$sEnv);
			}
		}

	}
?>
