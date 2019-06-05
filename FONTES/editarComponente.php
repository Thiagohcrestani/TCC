<?php
include('include/config.dba.php');

session_start();

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

$id = $_POST['id'];
$sql = "Select * from cadastrocomponentes where id_componente = $id";
$result	 = mysql_query($sql);


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
    <form class="painel col-lg-6 col-xs-10" name="pagina" method="post" action="UpdateComponente.php" >
		<div class="row form-group" style="margin-left:2px; margin-right:2px;" >
				<input type="hidden" name="id" value="<?php echo mysql_result($result,0,'id_componente')?>">
			    <div bgcolor="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><font color="white"><center><b>EDITAR COMPONENTES</b></center></font></div>
	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ><font color="white"><b>Nome Componente</b>:<br></font>
				<input type="text" name="nome" class="form-control" value="<?php echo mysql_result($result,0,'nome_componente')?>" ></div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Tipo de Componente:<br></b></font><select style="width: 150px;" name="tipocomponente">
					<option value="M" <?php if(mysql_result($result, 0, 'tipo_componente')=="T"){echo " selected ";}?>>Musical</option>
					<option value="B" <?php if(mysql_result($result, 0, 'tipo_componente')=="B"){echo " selected ";}?>>Brinquedo</option>
				</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><font color="white"><b>Status:<br></b></font><select style="width: 150px;" name="status">
					<option value="A" <?php if(mysql_result($result, 0, 'status')=="A"){echo " selected ";}?>>Ativo</option>
					<option value="I" <?php if(mysql_result($result, 0, 'status')=="I"){echo " selected ";}?>>Inativo</option>
				</select>
				</div>


			<br>
			<br>
			<br>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" bgcolor=""><input class="btn btn-primary btn-lg" type="submit" name="salvar" value="Salvar" ></div>	

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

	
	</html>

