<?php
// Incluir aquivo de conex�o
include("include/config.dba.php");

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

 
// Recebe o valor enviado
$valor = $_POST['valor'];
 $valor = addslashes($valor);
// Procura titulos no banco relacionados ao valor
$sql = mysql_query("SELECT id_sensor FROM bercosensor WHERE nome_sensor LIKE '".$valor."%' order by nome_sensor");
 
// Exibe todos os valores encontrados
//echo "<table border=1>";
echo"<div class='row'>";
while ($dados = mysql_fetch_object($sql)) {
	
	echo "<div style='margin-top:8px' class='col-lg-8 col-md-8 col-sm-8 col-xs-6'><font color=white><b>" . $dados->nome_sensor . "</b></font></div>";

}
//echo "</table>";
echo"</div>"; 
// Acentua��o
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>