<?php

/**
*	@desc Mysql Class extends of Mysqli Class
*	@author romain dumont
*/

	class Mysql{

		private $oStmt;
		private $_bindVarsArray = array();
		private $_columnName = array();
		private $_results = array();
		private $_oLoad;
		private $_oLog;
		private $_oEnv;
		private $_sServerHost;
		private $_sPsw;
		private $_sDataBaseName;
		private $_sUSerName;


		function __construct()
		{
			$this->_oLoad = new Loader();
			$this->_oLog = $this->_oLoad->load('Log');
                        $this->_oEnv = $this->_oLoad->load('Env');
			$this->_setConfVar();	
		}

		private function _setConfVar(){

			$this->_sServerHost = $this->_oEnv->getDbEnv('address');
			$this->_sPsw = $this->_oEnv->getDbEnv('psw');
			$this->_sDataBaseName = $this->_oEnv->getDbEnv('dbname');
			$this->_sUSerName = $this->_oEnv->getDbEnv('login');
		}

		//-- execute stored procedure
		public function executeStoPro($sProcName,$aParam){
			//log
			if($aParam==null) $sCall="call $sProcName();";
			else $sCall="call $sProcName('" . implode("', '", $aParam) . "');";
			$this->_oLog->addLog('Info',$sCall);
			mysqli_report(MYSQLI_REPORT_STRICT);

			try{
				$db = new mysqli($this->_sServerHost, $this->_sUSerName, $this->_sPsw, $this->_sDataBaseName);
				$this->oStmt = $db->prepare($sCall);
				
				if($this->oStmt->execute()){
					$this->oStmt->store_result();
		  
					$meta = $this->oStmt->result_metadata();
	
					if(is_object($meta)){
						while ($columnName = $meta->fetch_field()){
							$this->_bindVarsArray[] = &$this->_results[$columnName->name];
							$this->_columnName[] = $columnName->name;
						}
	  	
						call_user_func_array(array($this->oStmt, 'bind_result'), $this->_bindVarsArray);
						$meta->close();
					}
				}else{
					throw new Exception('mysqli::execute failed !'.$this->oStmt->error);
				}
			}catch(mysqli_sql_exception $e){
				throw $e;
			}catch(Exception $e){
				throw $e;
			}
		}

		//-- return next array
		public function getArrayAfterFetch(){
			$this->oStmt->fetch();
			return $this->_results;
		}

		//-- return next value by name
		public function getAfterFetch($column_name){
			$this->oStmt->fetch();
			return $this->_results[$column_name];
		}

		public function fetch(){
			return($this->oStmt->fetch());
		}

		public function get($column_name){
			return $this->_results[$column_name];
		}

		public function getArray(){
			return $this->_results;
		}

		public function getColumnName(){
			return $this->_columnName;
		}

	}



?>
