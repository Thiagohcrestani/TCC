<?php
if (!($conexao=mysql_pconnect($host,$user,$pass))) {
	echo "<center><font face=\"Verdana,Geneva,Arial,Helvetica,sans-serif\" size=\"+2\">Não foi possível estabelecer uma conexão com o Gerenciador MySQL. Favor contatar o Administrador.</font></center>";
	exit;
}
if (!($con=mysql_select_db($base,$conexao))) {
	echo "<center><font face=\"Verdana,Geneva,Arial,Helvetica,sans-serif\" size=\"+2\">Não foi possível estabelecer uma conexão com o banco de dados ".$base.". Favor contatar o Administrador.</font></center>";
	exit;
}
?>