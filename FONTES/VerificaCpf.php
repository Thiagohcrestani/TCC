<?php
include('include/config.dba.php');

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);


$cpf = $_POST["cpf"]; 


$sql = "SELECT * FROM cadastrousuario where cpf_usuario = '$cpf'";
$result_sql = mysql_query($sql,$conexao);
$n_sql = mysql_num_rows($result_sql);
if($n_sql>0){
	
	$nome = mysql_result($result_sql,0,"nome_usuario");
	echo"CPF Cadastrado Para ".$nome."\n Deseja continuar?";

}

?>
