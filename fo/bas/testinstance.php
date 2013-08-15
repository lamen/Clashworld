<?php

class test{

	function __construct($sValue){
		//extract($sValue);
		echo $sValue;
	
	}


}


$sObjName = 'test';
$sParam = 'cela fonctionne !!!';

$aParam = array('sParam'=>'Et ce n est pas tout');

$oObjtest = new $sObjName(extract($aParam));

/*
$var_array = array("color" => "blue",
                   "size"  => "medium",
                   "shape" => "sphere");
extract($var_array);

echo "$color, $size, $shape\n";
*/
?>