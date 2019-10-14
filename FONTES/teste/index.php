<?php
include('../include/config.dba.php');
	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);
$putData = fopen("php://input", "r");
ob_start();
print_r([$putData,$_REQUEST]);

$lado = "";

$tmp = $_REQUEST['temp'];//RECEBE O VALOR DA VARIAVEL TEMP DO SENSOR DE TEMPERATURA AMBIENTE
$mov = $_REQUEST['mov'];//RECEBE O VALOR DA VARIAVEL MOV DO SENSOR DE MOVIMENTO
$corp = $_REQUEST['corp'];//RECEBE O VALOR DA VARIAVEL CORP DO SENSOR DE TEMPERATURA CORPORAL
$bat = $_REQUEST['bat'];//RECEBE O VALOR DA VARIAVEL BAT DO SENSOR DE BATIMENTO CARDIACO

$posicao;//VARIAVEL DEFINIDA PARA RECEBER A POSIÇÃO QUE SE MOVIMENTOU E CALCULAR PARA QUAL LADO SE MOVIMENTOU


//DAS LINHAS 20 ATÉ 27, É FEITO O CALCULO COM BASE NO QUE A VARIAVEL RETORNOU E SALVO NA VARIAVEL $POSICAO.
if ($mov > 16000){
	$posicao = "Direita";

}else if($mov <= 4000 && $mov >= 2000){
	$posicao = "Centro";
}else{
	$posicao = "Esquerda";
}

echo "insert into ... ($tmp)";
$res = ob_get_clean();
file_put_contents('./log.txt',$res);


	// SALVA O VALOR DA VARIAVEL TMP NO BANCO DE DADOS NO SENSOR DE TEMPERATURA
	$sqlTemp = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Temperatura', observacao_evento = ($tmp) WHERE id_berco = '1' and id_sensor = '1'";
	$result_sql = mysql_query($sqlTemp,$conexao);

	// SALVA O VALOR DA VARIAVEL POSICAO NO BANCO DE DADOS NO SENSOR DE MOVIMENTAÇÃO
	$sqlMov = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Movimento', observacao_evento = '$posicao' WHERE id_berco = '1' and id_sensor = '4'";
	$result_sql = mysql_query($sqlMov,$conexao);
	
	// SALVA O VALOR DA VARIAVEL CORP NO BANCO DE DADOS NO SENSOR DE TEMPERATURA CORPORAL
	$sqlCorp = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Temperatura Corporal', observacao_evento = ($corp) WHERE id_berco = '1' and id_sensor = '5'";
	$result_sql = mysql_query($sqlCorp,$conexao);

	// SALVA O VALOR DA VARIAVEL BAT NO BANCO DE DADOS NO SENSOR DE BATIMENTOS CARDÍACOS
	$sqlBat = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = 'Batimento', observacao_evento = ($bat) WHERE id_berco = '1' and id_sensor = '3'";
	$result_sql = mysql_query($sqlBat,$conexao);



	
?>