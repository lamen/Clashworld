<?php

$aStoColumnName=array();

$db_connection = new mysqli('db407656441.db.1and1.com', 'dbo407656441', 'mina070603', 'db407656441');

$oStmt = $db_connection->prepare("select * from type");
$oStmt->execute();
$oStmt->store_result();
$meta = $oStmt->result_metadata();
while ($columnName = $meta->fetch_field()){
  echo $columnName->name."<br />";
  $aStoColumnName[]=$columnName->name;
}
echo "<br /><br />";
var_dump($aStoColumnName);



?>
