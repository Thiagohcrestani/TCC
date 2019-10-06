<?php
include('../include/config.dba.php');
	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);
$putData = fopen("php://input", "r");
ob_start();
print_r([$putData,$_REQUEST]);

$lado = "";

$tmp = $_REQUEST['temp'];
$mov = $_REQUEST['mov'];
echo "insert into ... ($tmp)";
$res = ob_get_clean();
file_put_contents('./log.txt',$res);

	$sqlTemp = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Temperatura', observacao_evento = ($tmp) WHERE id_berco = '1' and id_sensor = '1'";
	$result_sql = mysql_query($sqlTemp,$conexao);

	$sqlMov = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Movimento', observacao_evento = ($mov) WHERE id_berco = '1' and id_sensor = '4'";
	$result_sql = mysql_query($sqlMov,$conexao);


	
?>