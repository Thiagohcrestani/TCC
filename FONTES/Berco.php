<?php
session_start();

	include('seguranca.php');
	if (!verificaSessao()) {
		header("location: TelaLogin.php");
}
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> Novo Berço </title>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <!--<link href="style.css" rel="stylesheet" type="text/css" />
  <!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	        <!--<link href="style.css" rel="stylesheet" type="text/css" />
	        <!--<link href="estilo.css" rel="stylesheet" type="text/css">
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



 </head>

 <body class="imagem">
   <?php
	include("include/menu.php");
  ?>
   <center>
   <div class="row">
   <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"></div>
    <form class="painel col-lg-6 col-xs-10" name="pagina" method="post" action="ValidaBerco.php" >
		<div class="row form-group" style="margin-left:2px; margin-right:2px;" >

			    <div bgcolor="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><font color="white"><center><b>CADASTRO BERÇO</b></center></font></div>
	
	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Nome Criança</b>:<br></font>
				<input type="text" name="nome" class="form-control" required></div>
		

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Usuário<br></b></font><select required style="width: 200px;" multiple="multiple" name="usuario[]">
					<?php					
						$result_usuarios = mysql_query("SELECT * FROM cadastrousuario order by nome_usuario");
						while($row_result_usuarios = mysql_fetch_assoc($result_usuarios)) { ?>
					<option  value="<?php echo $row_result_usuarios['id_usuario']; ?>"><?php echo $row_result_usuarios['nome_usuario'];?></option>
					<?php
						}
					?>
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Sensores<br></b></font><select required multiple="multiple" style="width: 200px;" name="sensores[]">
					<?php					
						$result_usuarios = mysql_query("SELECT * FROM cadastrosensores order by nome_sensor");
						while($row_result_usuarios = mysql_fetch_assoc($result_usuarios)) { ?>
					<option required value="<?php echo $row_result_usuarios['id_sensor']; ?>"><?php echo $row_result_usuarios['nome_sensor'];?></option>
					<?php
						}
					?>
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Status<br></b></font>
				<select style="width: 150px;" name="status" >
					<option value="A">Ativo</option>
					<option value="I">Inativo</option>
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
 .painel{

background: linear-gradient(to bottom, rgba(101, 102, 103 ,1.0) 0%,rgba(44,80,107,0.6) 100%);
border-radius: 20px;


}
.imagem {
  background-image: url(../IMAGEM/Fundo.jpg);
  background-size: cover;
}    .load {
    width: 100px;
    height: 100px;
    position: absolute;
    top: 30%;
    left: 45%;
    color: blue;
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
