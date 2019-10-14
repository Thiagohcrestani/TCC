<?php
session_start();// INICIA SESSÃO DO USUÁRIO

	include('seguranca.php');  //INCLUI O ARQUIVO DE SEGURANÇA, QUE VERIFICA A SESSÃO INICIADA
	if (!verificaSessao()) {
		header("location: TelaLogin.php");
	}
	include('include/config.dba.php');// INCLUI O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS

	$conexao = mysql_pconnect($host,$user,$pass);// INICIA A CONEXÃO COM O BANCO DE DADOS
	mysql_select_db($base,$conexao);

	$id = $_POST['id'];
	$sql = "Select * from armazenamentodados";// SELECIONA TODOS OS DADOS DA TABELA ARMAZENAMENTO DADOS
	$result	 = mysql_query($sql);


	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> MENU </title>
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <!-- CSS UTILIZADOS PELO BOOTSTRAP PARA O LAYOUT DO SISTEMA-->
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
	include("include/menu.php");//INCLUI O MENU NO SISTEMA
  ?>
   <center>
   <div class="row">
   <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"></div>
    <form class="painel col-lg-6 col-xs-10" name="pagina" method="post" action="ValidaSensor.php" >
		<div class="row form-group" style="margin-left:2px; margin-right:2px;" >

			    <div bgcolor="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><font color="white"><center><b>Verificar Informações</b></center></font></div>
	
	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Berço<br></b></font><select 	 style="width: 200px;" name="berco" id="berco">
					<option disabled selected>Selecione Um berço</option>
					<?php		
						// SELECIONA OS BERÇOS VINCULADOS AO USUÁRIO LOGADO E RETORNA PARA O COMBOBOX	
						$result_usuarios = mysql_query("SELECT b.*, c.nome_crianca FROM bercousuario b, cadastroberco c where berco = id_berco and usuario =  ".$_SESSION['baby_id']);
						while($row_result_usuarios = mysql_fetch_assoc($result_usuarios)) { ?>
						
					<!-- RETORNA OS VALORES PARA O COMBOBOX-->
					<option value="<?php echo $row_result_usuarios['berco']; ?>"><?php echo $row_result_usuarios['nome_crianca'];?></option>
					<?php
						}
					?>
				
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Sensor<br></b></font><select style="width: 200px;" name="sensor" id="sensor">
				<!--RECEBE OS SENSORES QUE ESTÃO VINCULADOS AO BERÇO SELECIONADO-->	
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
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" bgcolor=""><input type="button" onclick="window.location.href='index_menu.php'" 
					class="btn btn-success btn-lg" name="cancelar" value="Retornar ao menu Principal" ></input></div>		
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

background: linear-gradient(to bottom, rgba(101, 102, 103 ,1.0) 0%,rgba(44,80,107,0.6) 100%);/*DETERMINA AS BORDAS E AS CORES DO FORMULARIO*/
border-radius: 20px;


}
.imagem {
  background-image: url(../IMAGEM/Fundo.jpg);/*DETERMINA A IMAGEM DE FUNDO*/
  background-size: cover;
}
 </style>
<script>
 
 function buscarNoticias(valor) {//FUNÇÃO PARA BUSCAR OS BERÇOS VINCULADOS AO USUÁRIO LOGADO
	$.ajax({
		type: "POST",
		url: "buscaInformacoes.php",//ARQUIVO ONDE BUSCA AS INFORMAÇÕES
		data: {valor: valor}

	}).done(function (data){
		console.log(data);
		$("#sensor").html(data);//PREENCHE O COMBOBOX DE SENSOR CONFORME O BERÇO SELECIONADO
		
	})
 }

	$("#berco").on("change",function(){//CONFORME OUTRO BERÇO É SELECIONADO, ELE BUSCA OS SENSORES VINCULADOS AO BERÇO E RETORNA NOVAMENTE.
		var id = $(this).val();
		buscarNoticias(id)//VOLTA PARA A FUNÇÃO BUSCAR NOTICIAS.
	})

	function get(valor) {//FUNÇÃO PARA BUSCAR OS VALORES DOS SENSORES SELECIONADOS ACIMA, PARA RETORNAR OS VALORES AOS INPUTS.
		$.ajax({
		type: "POST",
		url: "buscainformacoes2.php",//ARQUIVO ONDE FAZ O SELECT NO BANCO DE BUSCA DAS INFORMAÇÕES
		data: {valor: valor}

		}).done(function(data){
			var data = JSON.parse(data);
		  $("input[name=tipoevento]").attr("value", data["tipo_evento"]);//RETORNA O TIPO DO EVENTO DO SENSOR SELECIONADO AO INPUT TIPO EVENTO
		  $("input[name=dataevento]").attr("value", data["data_hora_evento"]);//RETORNA O DATA E HORA DO EVENTO DO SENSOR SELECIONADO AO INPUT DATA E HORA EVENTO
		  $("input[name=observacao]").attr("value", data["observacao_evento"]);//RETORNA O TIPO DO EVENTO DO SENSOR SELECIONADO AO INPUT TIPO EVENTO
		});
	}

	$("#sensor").on("change",function(){//COFORME OUTRO SENSOR É SELECIONADO, ELE BUSCA NOVAMENTE E RETORNA OS VALORES AOS INPUTS.
		var id = $(this).val();
		get(id);
	});

</script>