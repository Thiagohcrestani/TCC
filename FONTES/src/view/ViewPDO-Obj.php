<?php

include("include/config.dba.php");

$conexao = mysql_pconnect($host,$user,$pass);
mysql_select_db($base,$conexao);

// $title = "PDO Assoc";
// include_once __DIR__ . '/../template/head.inc.php';

$sql = "select 
            u.id_usuario,
            c.nome_cliente,
            u.nome_usuario,
            u.tipo_usuario,
            c.cpf,
            u.data_cadastro,
            u.status
        from usuario u
            inner join cliente c
                on c.id_cliente = u.id_cliente
        order by id_usuario";
try {
    $results = $conn->query($sql);
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}
?>

<body class="bg-light">
    <table cellpadding="5" cellspacing="0" border="0" align="center" width="1000">
        <tbody>
            <tr>
                <th width="100">Código</th>
                <th width="300">Cliente</th>
                <th width="200">Usuário</th>
                <th width="50">Tipo</th>
                <th width="150">CPF</th>
                <th width="50">Status</th>
            </tr>
            <?php if ($results) : ?>
                <?php $x = 0; ?>
                <?php while ($result = $results->fetch(PDO::FETCH_OBJ)) : ?>
                    <?php $x++; ?>
                    <tr style="<?= $x % 2 == 0 ? 'background-color: #FFF' : 'background-color: #DDD' ?>">
                        <td align="center">
                            <?= $result->id_usuario ?>
                        </td>
                        <td align="center">
                            <?= $result->nome_cliente ?>
                        </td>
                        <td align="center">
                            <?= $result->nome_usuario ?>
                        </td>
                        <td align="center">
                            <?= $result->tipo_usuario ?>
                        </td>
                        <td align="center">
                            <?= $result->cpf ?>
                        </td>
                        <td align="center">
                            <?= $result->status ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
<?php
include_once __DIR__ . '/../template/scripts.inc.php';
include_once __DIR__ . '/../template/footer.inc.php';
