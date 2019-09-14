  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="index_menu.php" ><img src="../imagem/baby.png" width="150" height="75" alt="login" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" ">
    <ul class="navbar-nav mr-auto">
	<?php
		if ($_SESSION["baby_tipo"] === "A"):



	?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuário
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Usuario.php">Novo Usuário</a>
          <a class="dropdown-item" href="PesquisaUsuario.php">Editar Usuário</a>
        </div>
      </li>
	     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Berço
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Berco.php">Novo Berço</a>
          <a class="dropdown-item" href="pesquisaBerco.php">Editar Berço</a>
        </div>
      </li>
	   
	 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sensor
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Sensor.php">Novo Sensor</a>
          <a class="dropdown-item" href="PesquisaSensor">Editar Sensor</a>
        </div>
      </li>
	   <?php
		endif


	  ?>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Informações
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Informacoes.php">Verificar Informações</a>
        </div>
      </li>
    </ul>
  </div>

  <span class="navbar-text">
		
		<font size="" face="verdana" color="" align="right"><?php echo $_SESSION["baby_usuario"];?></font>	
		<button onclick="window.location.href='logoff.php'" class="btn btn-sm btn-outline-secondary" type="button">Sair</button>
	</span>
</nav>

