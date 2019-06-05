<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	$nome = addslashes($nome);
	$localizacaosensor =  $_POST['localizacaosensor'];
	$localizacaosensor = addslashes($localizacaosensor);
	$tiposensor =  $_POST['tiposensor'];
	$tiposensor = addslashes($tiposensor);
	$status =  $_POST['status'];
	$status = addslashes($status);
	

	$sql = "update cadastrosensores set nome_sensor = '{$nome}', 
	localizacao_sensor = '{$localizacaosensor}',
	tipo_sensor = '{$tiposensor}',
	status_sensor = '{$status}'
	where id_sensor = '{$_POST['id']}'";
	$result_sql = mysql_query($sql,$conexao);

	header("location: PesquisaSensor.php");
?>