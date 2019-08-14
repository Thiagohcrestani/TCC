<?php

session_start();

include('seguranca.php');
	if (!verificaSessao()) {
		header("location: TelaLogin.php");
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="funcs.js"></script>
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	        <!--<link href="style.css" rel="stylesheet" type="text/css" />
	        <!-- <link href="estilo.css" rel="stylesheet" type="text/css">
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

   
   <div class="row" style="margin-left:2px; margin-right:2px;">
    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-0"></div>
	<div class="painel col-lg-6 col-md-8 col-sm-8 col-xs-12" id="pesquisa">
	<center>
		<div class="row">	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><center><b>EDITAR SENSOR</b></center></font></div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0"></div>	
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><font color="white"><b>Pesquisar </b>:</font>
			
			<input type="text" class="form-control" name="nome" size="28" id="busca" onkeyup="buscarNoticias(this.value)"></div>
			<br>
			<br>
			<br>
		</div>
		<button type="button" class="btn btn-primary btn-sm" onclick="buscarNoticias(this.value)">Listar Todos</button>
		<div id="conteudo"></div>
		<div id="resultado"></div>
		<br>
		<br>
			
	</center>
	 </div>
	 </div>
</div>
	  <div id="divEdit"> </div>
 </body>
 <style>
  .imagem {
  background-image: url(../IMAGEM/Fundo.jpg);
  background-size: cover;
}
7</style>
<style>
 .painel{

background: linear-gradient(to bottom, rgba(101, 102, 103 ,1.0) 0%,rgba(44,80,107,0.6) 100%);
border-radius: 10px;


}
 </style>
 <script>
 
 function buscarNoticias(valor) {
	$.ajax({
		type: "POST",
		url: "buscaSensor.php",
		data: {valor: valor}

	}).done(function (data){
		$("#resultado").html(data);
		
	})


}
 function exibirConteudo(id) {
	$.ajax({
		type: "POST",
		url: "editarSensor.php",
		data: {id: id}

	}).done(function (data){
		$("#pesquisa").hide(300);
		$("#resultado").hide(300);
		$("#divEdit").html(data);
		
		
	})

	}
	function Excluir (id) {
	$.ajax({
		type: "POST",
		url: "ExcluirSensor.php",
		data: {id: id}

	}).done(function (data){
		
		buscarNoticias($("#busca").val());
	})

	}
	function setEstado(){	
		var id=$("#selectEstado").val();
			alert(id);
				$("#"+id).attr('selected','selected');
			

		
		}

	function confirmar(id) {
		$('#modalExemplo').modal("show");
		$('#Confirma').click(function(){ 
			Excluir(id);
			$('#modalExemplo').modal("hide");
			
		});
	
	}
	
</script>
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a>Deseja Realmente Remover este sensor?</a>
      </div>
      <div class="modal-footer">
	    <button id="Confirma" class="btn btn-danger">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</html>
