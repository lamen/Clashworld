<?php

/**
*	@desc Log
*	@author romain dumont
*/

	class Log{

		const LOG_PATH = '../../weblogs';
		private $aLevel = array('Error','Notice','Warning','Info');
		private $rFile;

		function __construct(){
			date_default_timezone_set('Europe/Paris');
			if(!file_exists(self::LOG_PATH.'/'.date("Y").'/'.date("m").'/'.date("d").'/')) mkdir(self::LOG_PATH.'/'.date("Y").'/'.date("m").'/'.date("d").'/',0755,true);
			$this->rFile=fopen(self::LOG_PATH.'/'.date("Y").'/'.date("m").'/'.date("d").'/'.'weblog.log','a+');
		}


		function addLog($sLevel,$sMessage){
			if(!in_array($sLevel,$this->aLevel)) return false;
			fwrite($this->rFile,date("Y-m-d H:i:s").';'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].';'.$_SERVER['REMOTE_ADDR'].';'.$_SERVER['HTTP_USER_AGENT'].';'.$_SERVER['SCRIPT_URI'].';'.$sLevel.';'.str_replace(array("\r","\r\n","\n"),'', trim($sMessage))."\r\n");
			return true;
		}
	}


?>
