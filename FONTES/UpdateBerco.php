<?php

	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	$nome = addslashes($nome);
	$idade =  $_POST['idade'];
	$idade = addslashes($idade);
	$usuario =  $_POST['usuario'];
	$usuario = addslashes($usuario);
	$status =  $_POST['status'];
	$status = addslashes($status);

		
	$sql = "update cadastroberco set nome_crianca = '{$nome}', idade_crianca = '{$idade}', id_usuario = '{$usuario}',	status = '{$status}'
	where id_berco = '{$_POST['id']}'";
	$result_sql = mysql_query($sql,$conexao);

	$id = $_POST['id'];

	$sql = "delete from bercosensor where berco = $id";
	$result_sql = mysql_query($sql,$conexao);
	$sql = "delete from bercocomponente where berco = $id";
    $result_sql = mysql_query($sql,$conexao);	


	foreach ($_REQUEST["sensores"] as $sensor){
		$sql = "insert into bercosensor (berco, sensor) values($id, $sensor)";
		$result_sql = mysql_query($sql,$conexao);

	}
	foreach ($_REQUEST["componente"] as $componente){
		$sql = "insert into bercocomponente (berco, componente) values($id, $componente)";
		$result_sql = mysql_query($sql,$conexao);

	}
	echo mysql_error();

	header("location: PesquisaBerco.php");
?>