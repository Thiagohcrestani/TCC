<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	$nome = addslashes($nome);
	$tipocomponente =  $_POST['tipocomponente'];
	$tipocomponente = addslashes($tipocomponente);
	$status =  $_POST['status'];
	$status = addslashes($status);


	$sql = "insert into cadastrocomponentes (nome_componente, tipo_componente, status) values('{$nome}', '{$tipocomponente}', '{$status}')";
	$result_sql = mysql_query($sql,$conexao);
	header("location: Componente.php");
?>