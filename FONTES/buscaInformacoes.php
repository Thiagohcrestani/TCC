<?php
// Incluir aquivo de conexão
include("include/config.dba.php");

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

 
// Recebe o valor enviado
$valor = $_POST['valor'];
 $valor = addslashes($valor);
// Procura titulos no banco relacionados ao valor
$sql = mysql_query("select b.*, c.id_sensor, c.nome_sensor from bercosensor b, cadastrosensores c where b.sensor = c.id_sensor and berco = ".$valor);
 
// Exibe todos os valores encontrados

while ($dados = mysql_fetch_object($sql)) {
	
	echo "<option style='margin-top:8px' class='col-lg-8 col-md-8 col-sm-8 col-xs-6' value=" . $dados->id_sensor . "><font color=white><b>" . $dados->nome_sensor . "</b></font></option>";

}

header("Content-Type: text/html; charset=ISO-8859-1",true);
?>