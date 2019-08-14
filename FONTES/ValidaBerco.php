<?php
	include('include/config.dba.php');
	
	
	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];


	$sql = "insert into cadastroberco (nome_crianca, idade_crianca, id_usuario, status) values('{$_POST['nome']}', '{$_POST['idade']}', '{$_POST['usuario']}', '{$_POST['status']}')";
	$result_sql = mysql_query($sql,$conexao);
	$id = (mysql_insert_id());

	foreach ($_REQUEST["sensores"] as $sensor){
		$sql = "insert into bercosensor (berco, sensor) values($id, $sensor)";
		$result_sql = mysql_query($sql,$conexao);

	}
	foreach ($_REQUEST["componentes"] as $componente){
		$sql = "insert into bercocomponente (berco, componente) values($id, $componente)";
		$result_sql = mysql_query($sql,$conexao);

	}

	header("location: Berco.php");
?>