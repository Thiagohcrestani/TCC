<?php
// Incluir aquivo de conexão
include("include/config.dba.php");

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

 
// Recebe o valor enviado
$valor = $_POST['valor'];
 $valor = addslashes($valor);
// Procura titulos no banco relacionados ao valor
$sql = mysql_query("select b.*, c.tipo_evento, c.data_hora_evento, c.observacao_evento from cadastrosensores b, armazenamentodados c where b.id_sensor = c.id_sensor and c.id_sensor = ".$valor);
 
// Exibe todos os valores encontrados
//echo "<table border=1>";
//echo"<div class='row'>";
while ($dados = mysql_fetch_object($sql)) {
	echo json_encode($dados);
	//echo "<option style='margin-top:8px' class='col-lg-8 col-md-8 col-sm-8 col-xs-6'><font color=white><b>" . $dados->nome_sensor . "</b></font></option>";

}
//echo "</table>";
//echo"</div>"; 
// Acentuação
//header("Content-Type: text/html; charset=ISO-8859-1",true);
?>