<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	
	$sql = "insert into cadastrosensores (nome_sensor, localizacao_sensor, tipo_sensor, status_sensor) values('{$_POST['nome']}', '{$_POST['localizacaosensor']}', '{$_POST['tiposensor']}', '{$_POST['status']}')";
	$result_sql = mysql_query($sql,$conexao);
	header("location: Sensor.php");
?>