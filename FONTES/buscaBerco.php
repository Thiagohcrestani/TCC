<?php
// Incluir aquivo de conexão
include("include/config.dba.php");

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

 
// Recebe o valor enviado
$valor = $_POST['valor'];
 $valor = addslashes($valor);
// Procura titulos no banco relacionados ao valor
$sql = mysql_query("SELECT id_berco, nome_crianca FROM cadastroberco WHERE nome_crianca LIKE '".$valor."%' order by nome_crianca");
 
// Exibe todos os valores encontrados
//echo "<table border=1>";
echo"<div class='row'>";
while ($dados = mysql_fetch_object($sql)) {
	
	echo "<div style='margin-top:8px' class='col-lg-8 col-md-8 col-sm-8 col-xs-6'><font color=white><b>" . $dados->nome_crianca . "</b></font></div>";
	echo "<div style='margin-top:2px' class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>".
		"<button class='btn btn-sm btn-warning' onclick='exibirConteudo(".$dados->id_berco.")'>Editar</button>".
		"&nbsp;&nbsp;<button class='btn btn-danger btn-sm' onclick = 'confirmar(".$dados->id_berco.")'> Excluir </button></div>";

}
//echo "</table>";
echo"</div>"; 
// Acentuação
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>