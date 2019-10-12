<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php
	include('seguranca.php');
	if (verificaSessao()) {
		header("location: index_menu.php");
}
?>
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
	    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

	</head>
	<script language="JavaScript" type="text/javascript">
	<!--
	function valida() {
		
		var now = new Date;
		var anoatual = now.getFullYear();

		var str = form1.login.value
		if (str.length > 15) {
			alert("O campo Login está limitado a 15 caracteres");
			form1.login.focus();
			return false;
		}
		var login = form1.login.value;
		if (login == "") {
			alert("O campo (Login) esta em branco!\nPor favor entre com um Login!");
			form1.login.focus();
			return false;
		}
			
		var senha = form1.senha.value
		if (senha == ""){
			alert("O campo (Senha) esta em branco!\nPor favor entre com uma Senha!")
			return false;
		}
		
		return true;
	}
-->
</script>
<body background="">
	
<div style="margin: auto">
	<form name="form1" action="ValidaLogin.php" method="post" onsubmit="return valida();" >
	  	<div> 
			<img class="mb-4" src="../IMAGEM/baby.png" alt="" width="250">
		    <label class="sr-only">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
	        <br>
            <label for="inputPassword"  class="sr-only">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
	        <br>
	    </div>
             <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	      <br>

    </form>	
</div>
</body>
</html>
