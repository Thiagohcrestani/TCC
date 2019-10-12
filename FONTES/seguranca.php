<?php
include('include/config.dba.php');
session_start();

function criaSessao($login,$senha,$conexao){
	$sql = "SELECT * from cadastrousuario where login_usuario = '$login' and senha_usuario = '$senha'";
	$result_sql = mysql_query($sql,$conexao);


	$_SESSION["baby_id"]=mysql_result($result_sql,0,"id_usuario");
	$_SESSION["baby_usuario"]=mysql_result($result_sql,0,"nome_usuario");
	$_SESSION["baby_senha"]=mysql_result($result_sql,0,"senha_usuario");
	$_SESSION["baby_tipo"]=mysql_result($result_sql,0,"tipousuario");
	$_SESSION["baby_status"]=mysql_result($result_sql,0,"status");
	





}
function validaLogin($login,$senha,$conexao){
	$sql = "SELECT * from cadastrousuario where login_usuario = '$login' and senha_usuario = '$senha'";
	$result_sql = mysql_query($sql,$conexao);
	$n_sql = mysql_num_rows($result_sql);	

	if ($n_sql!=0){
		return true;

	}else {
		return false;
	}

}

function verificaSessao(){
	if (isset($_SESSION["baby_id"])) {
		return true;

	}else{
		return false;
	}
}	

?>