<?php
include('include/config.dba.php');

session_start();

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

$id = $_POST['id'];
$sql = "Select * from cadastroberco where id_berco = $id";
$result	 = mysql_query($sql);

$sensores=[];
$rs = mysql_query("SELECT * FROM bercosensor where berco=$id");
while($row_result_sensores = mysql_fetch_assoc($rs)){
	$sensores[]=$row_result_sensores['sensor'];

}





$usuario=[];
$ru = mysql_query("SELECT * FROM bercousuario where berco=$id");
while($row_result_usuarios = mysql_fetch_assoc($ru)){
	$usuario[]=$row_result_usuarios['usuario'];

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="funcs.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <!-- <link href="estilo.css" rel="stylesheet" type="text/css">
 --> </head>

 <body class="imagem">
 <center>
      <div class="row">
   <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"></div>
    <form class="painel col-lg-6 col-xs-10" name="pagina" method="post" action="UpdateBerco.php" onsubmit="return ValidaCPF();" >
		<div class="row form-group" style="margin-left:2px; margin-right:2px;" >
				<input type="hidden" name="id" value="<?php echo mysql_result($result,0,'id_berco')?>">
			    <div bgcolor="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><font color="white"><center><b>EDITAR BERÇO</b></center></font></div>
	
	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Nome Criança</b>:<br></font>
				<input type="text" name="nome" class="form-control" value="<?php echo mysql_result($result,0,'nome_crianca')?>"></div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Usuário<br></b></font><select required style="width: 200px;" name="usuario[]" multiple="multiple">
					<?php					
						$result_usuarios = mysql_query("SELECT * FROM cadastrousuario order by nome_usuario");
						while($row_result_usuarios = mysql_fetch_assoc($result_usuarios)) { ?>
							<option value="<?php echo $row_result_usuarios['id_usuario']; ?>" <?php if (in_array($row_result_usuarios['id_usuario'], $usuario)){echo 'selected="selected"';}?>><?php echo $row_result_usuarios['nome_usuario'];?></option>
						<?php
						}
					?>
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Sensores<br></b></font><select required multiple="multiple" style="width: 200px;" name="sensores[]">
					<?php					
						$result_sensores = mysql_query("SELECT * FROM cadastrosensores order by nome_sensor");
						while($row_result_sensores = mysql_fetch_assoc($result_sensores)) { ?>
					<option value="<?php echo $row_result_sensores['id_sensor']; ?>" <?php if (in_array($row_result_sensores['id_sensor'], $sensores)){echo 'selected="selected"';}  ?>><?php echo $row_result_sensores['nome_sensor'];?></option>
					<?php
						}
					?>
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Status<br></b></font>
				<select style="width: 150px;" name="status">
					<option value="A" <?php if(mysql_result($result, 0, 'status')=="A"){echo " selected ";}?>>Ativo</option>
					<option value="I" <?php if(mysql_result($result, 0, 'status')=="I"){echo " selected ";}?>>Inativo</option>
				</select>
				</div>

			<br>
			<br>
			<br>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" bgcolor=""><input class="btn btn-primary btn-lg" type="submit" name="salvar" value="Salvar" ></div>	
				<br>
				<br>
				<br>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" bgcolor=""><input type="button" onclick="window.location.href='index_menu.php'" class="btn btn-danger btn-lg" name="cancelar" value="Cancelar" ></div>		
			<br>
			<br>
			<br>
		</div>
	</form>
</div>
</center>
 </body>
 <style>
  .imagem {
  background-image: url(../IMAGEM/Fundo.jpg);
  background-size: cover;
}
</style>

	<script>
	function ValidaCPF(){
	var strCPF = $("#cpf").val();
    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000"){
		alert("CPF Inválido");
		strCPF = $("#cpf").val("");
	return false;
	}
     
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	 Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ){
		alert("CPF Inválido");
		strCPF = $("#cpf").val("");
	return false;
   }
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ){
		alert("CPF Inválido");
		strCPF = $("#cpf").val("");
	return false;
	}
    return true;
	}


	function verificaCpf() {
	var cpf =$("#cpf").val();
		
	$.ajax({
		type: "POST",
		url: "VerificaCpf.php",
		data: {cpf: cpf}

	}).done(function (data){
		if (data!=""){
			var txt;
			var r = confirm(data);
			if (r == true) {
	
		   } else {
				$("#cpf").val("");
			}
		}
		
		
		
	})

	}
	</script>
	</html>

