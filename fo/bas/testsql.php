<?php

require_once(dirname(dirname(__FILE__))."/include/loader.php");
$oLoad = new loader;
$oSql = $oLoad->load('sql');
$oSql->callStoPro('is_user_registred_v2',array(1=>'roroatwork@gmail.com',2=>'c81a8123116ef2881b1ea82887988c17'));
var_dump($oSql->getNextValueByArray());

?>