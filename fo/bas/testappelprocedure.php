<?php

//-- Test appel procedure stockees mysql
//$link = mysql_connect('db394027558.db.1and1.com:3306', 'dbo394027558', 'mina070603');
//mysql_select_db('db394027558', $link);

class MySQLDB extends mysqli{

}

$db_connection = new MySQLDB('db407656441.db.1and1.com', 'dbo407656441', 'mina070603', 'db407656441');

if($result = $db_connection->query("call is_user_registred('roroatwork@gmail.com','c81a8123116ef2881b1ea82887988c17',@a);")){

	$res = $db_connection->query("select @a as id_user;");

	if ($res->num_rows > 0){
		$row = $res->fetch_assoc();
		echo 'id client : '.$row['id_user'];
		$res->close();

	}else echo 'Pas de resultat';
}else echo 'Erreur Qy';


?>

