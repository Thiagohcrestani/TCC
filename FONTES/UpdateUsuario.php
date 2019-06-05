<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	$nome = addslashes($nome);
	$cpf =  $_POST['cpf'];
	$cpf = addslashes($cpf);
	$login =  $_POST['login'];
	$login = addslashes($login);
	$senha =  $_POST['senha'];
	$senha = addslashes($senha);
	$tipousuario =  $_POST['tipousuario'];
	$tipousuario = addslashes($tipousuario);
	$status =  $_POST['status'];
	$status = addslashes($status);

		
	$sql = "update cadastrousuario set nome_usuario = '{$nome}', 
	cpf_usuario = '{$cpf}',
	login_usuario = '{$login}',
	senha_usuario = MD5('{$senha}'),	
	tipousuario = '{$tipousuario}',
	status = '{$status}'
	where id_usuario = '{$_POST['id']}'";
	$result_sql = mysql_query($sql,$conexao);

	header("location: PesquisaUsuario.php");
?>