<?php

	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

    $nome =  $_POST['nome'];
	$nome = addslashes($nome);
	$idade =  $_POST['idade'];
	$idade = addslashes($idade);
	$qtdsensores =  $_POST['qtdsensores'];
	$qtdsensores = addslashes($qtdsensores);
	$usuario =  $_POST['usuario'];
	$usuario = addslashes($usuario);
	$sensor =  $_POST['sensor'];
	$sensor = addslashes($sensor);
	$componente =  $_POST['componente'];
	$componente = addslashes($componente);
	$status =  $_POST['status'];
	$status = addslashes($status);

		
	$sql = "update cadastroberco set nome_crianca = '{$nome}', 
	idade_crianca = '{$idade}',
	quantidadesensores = '{$qtdsensores}',
	id_usuario = '{$usuario}',	
	id_sensor = '{$sensor}',
	id_componente = '{$componente}',
	status = '{$status}'
	where id_berco = '{$_POST['id']}'";
	$result_sql = mysql_query($sql,$conexao);

	header("location: PesquisaBerco.php");
?>