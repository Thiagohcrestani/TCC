<?php

include_once __DIR__ . '/../config/Config.dba.php';
	$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

// $title = "PDO Assoc";
// include_once __DIR__ . '/../template/head.inc.php';

$sql = mysql_query("SELECT * from gerarelatorio");

?>

<body class="bg-light">
    <table cellpadding="5" cellspacing="0" border="0" align="center" >
        <tbody>
            <tr>
                <th width="100"><font color="white"><center>Id Berço</center><font></th>
                <th width="300"><font color="white"><center>Id Sensor</center><font></th>
                <th width="200"><font color="white"><center>Data e Hora do Evento</center><font></th>
                <th width="50"><font color="white"><center>Tipo Evento</center><font></th>
                <th width="150"><font color="white"><center>Valor Evento</center><font></th>
            </tr>
				<?php $x = 0; ?>
                <?php while ($dados = mysql_fetch_object($sql)) { ?>
				   <?php $x++; ?>
                    <tr style="<?= $x % 2 == 0 ? 'background-color: #FFF' : 'background-color: #DDD' ?>">
                        <td align="center">
                            <?= $dados->id_berco ?>
                        </td>
                        <td align="center">
                            <?= $dados->id_sensor ?>
                        </td>
                        <td align="center">
                            <?= $dados->data_hora_evento ?>
                        </td>
                        <td align="center">
                            <?= $dados->tipo_evento ?>
                        </td>
                        <td align="center">
                            <?= $dados->observacao_evento ?>
                        </td>
                        
                    </tr>
<?php } ?>
        </tbody>
    </table>
</body>
<?php

//include_once __DIR__ . '/../template/scripts.inc.php';
//include_once __DIR__ . '/../template/footer.inc.php';
