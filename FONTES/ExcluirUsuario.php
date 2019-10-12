<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $id =  $_POST['id'];

	try{
	$sql = "delete from cadastrousuario where id_usuario = $id";
	$result_sql = mysql_query($sql,$conexao);
	echo "ok";
	} catch(Exception $e) {
		echo $e->getMessage();

	}
	
	

	//header("location: index_menu.html");
?>