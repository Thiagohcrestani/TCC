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
	

	$sql = "update cadastrocomponentes set nome_componente = '{$nome}', 
	tipo_componente = '{$tipocomponente}',
	status = '{$status}'
	where id_componente = '{$_POST['id']}'";
	$result_sql = mysql_query($sql,$conexao);

	header("location: PesquisaComponente.php");
?>