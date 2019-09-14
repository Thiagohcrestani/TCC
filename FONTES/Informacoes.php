<?php
session_start();

	include('seguranca.php');
	if (!verificaSessao()) {
		header("location: TelaLogin.php");
	}
	include('include/config.dba.php');

	$conexao = mysql_pconnect($host,$user,$pass);
	mysql_select_db($base,$conexao);

	$id = $_POST['id'];
	$sql = "Select * from armazenamentodados";
	$result	 = mysql_query($sql);


	
	//$result	 = mysql_query($sql);

	//echo $sql2 = mysql_query("SELECT id_sensor FROM bercosensor WHERE sensor LIKE '".$valor."%' order by sensor");
	//die();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> MENU </title>
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
    <form class="painel col-lg-6 col-xs-10" name="pagina" method="post" action="ValidaSensor.php" >
		<div class="row form-group" style="margin-left:2px; margin-right:2px;" >

			    <div bgcolor="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><font color="white"><center><b>Verificar Iformações</b></center></font></div>
	
	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Berço<br></b></font><select 	 style="width: 200px;" name="berco" id="berco">
					<option disabled selected>Selecione Um berço</option>
					<?php					
						$result_usuarios = mysql_query("SELECT b.*, c.nome_crianca FROM bercousuario b, cadastroberco c where berco = id_berco and usuario =  ".$_SESSION['baby_id']);	
						while($row_result_usuarios = mysql_fetch_assoc($result_usuarios)) { ?>
						
					
					<option value="<?php echo $row_result_usuarios['berco']; ?>"><?php echo $row_result_usuarios['nome_crianca'];?></option>
					<?php
						}
					?>
				
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Sensor<br></b></font><select style="width: 200px;" name="sensor" id="sensor">
					<?php					
						//$result_sensores = mysql_query("select b.*, c.nome_sensor from bercosensor b, cadastrosensores c where b.sensor = c.id_sensor and berco = 1 ;");
						//while($row_result_sensores = mysql_fetch_assoc($result_sensores)) { ?>
					<!--<option value="<?php echo $row_result_sensores['id_sensor']; ?>"><?php echo $row_result_sensores['nome_sensor'];?></option>-->
					<?php
						//}
					?>
				
				</select>
				</div>
				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Tipo Evento</b>:<br></font>  
					<input type="text" name="tipoevento" class="form-control"></input>
					
				</div>

				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Data e Hora do evento</b>:<br></font>
				<input type="text" name="dataevento" class="form-control" ></input>
				</div>
				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Observações Evento</b>:<br></font>
				<input type="text" name="observacao" class="form-control" ></input>
				</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" bgcolor=""><input class="btn btn-primary btn-lg" type="submit" name="salvar" value="Salvar" ></input></div>	
				<br>
				<br>
				<br>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" bgcolor=""><input type="button" onclick="window.location.href='index_menu.php'" class="btn btn-danger btn-lg" name="cancelar" value="Cancelar" ></input></div>		
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
}
 </style>
<script>
 
 function buscarNoticias(valor) {
	$.ajax({
		type: "POST",
		url: "buscaInformacoes.php",
		data: {valor: valor}

	}).done(function (data){
		console.log(data);
		$("#sensor").html(data);
		
	})
 }

	$("#berco").on("change",function(){
		var id = $(this).val();
		buscarNoticias(id)
	})

	function get(valor) {
		$.ajax({
		type: "POST",
		url: "buscainformacoes2.php",
		data: {valor: valor}

		}).done(function(data){
			var data = JSON.parse(data);
		  $("input[name=tipoevento]").attr("value", data["tipo_evento"]);
		  $("input[name=dataevento]").attr("value", data["data_hora_evento"]);
		  $("input[name=observacao]").attr("value", data["observacao_evento"]);
		});
	}

	$("#sensor").on("change",function(){
		var id = $(this).val();
		get(id);
	});

</script>