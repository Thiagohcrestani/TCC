<?php
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	
	$sql = "insert into cadastrousuario (nome_usuario, cpf_usuario, Login_usuario, senha_usuario, tipousuario, status) values('{$_POST['nome']}', '{$_POST['cpf']}', '{$_POST['login']}', MD5('{$_POST['senha']}'), '{$_POST['tipousuario']}', '{$_POST['status']}')";
	$result_sql = mysql_query($sql,$conexao);
	header("location: Usuario.php");
?>