<html>

<head>
    <meta charset="utf-8" />
    <title>Listagem de Tarefas</title>
    <link rel="stylesheet" href="tarefas.css" type="text/css" />
</head>

</html>

<?php
session_start();

include "banco.php";
$mostrar = array(
    'id' => '',
    'nome' => '',
    'cpf' => '',
    'endereco' => '',
    'agencia' => '',
    'valor' => ''
);

?>

<body>
    <div class="corpo">
        <?php include "menu.php"; ?>
        <h1><a href="index.php">BANCO</a></h1>
        <div class="pesquisa">
            Pesquisar:
            <form method="GET" action="">
                <input type="text" name="nome" size="20" maxlength="5" required />
                <input type="submit" name="SendPesqUser" value="Pesquisar">
            </form>
        </div>
        <br>
        <h3>Operação Bancaria >> Pesquisa</h3>
        <div class="formulario">
            <fieldset>
                <?php
                $SendPesqUser = filter_input(INPUT_GET, 'SendPesqUser', FILTER_SANITIZE_STRING);
                if ($SendPesqUser) {
                    $nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING);
                    $result_usuario = "SELECT * FROM bancaria WHERE nome LIKE '%$nome%'";
                    $resultado_usuario = mysqli_query($conexao, $result_usuario);
                    while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
                        echo "
                Nome: " . $row_usuario['nome']  . "</td><br/><td>Agência: " . $row_usuario['agencia'] . "<br/><td>Conta: " . $row_usuario['id'] . "</tr><br><br>";
                    }
                    echo "</br><form method='post' action='../novo'>
                            <input type='submit'value='Voltar'></input>
                        </form>";
                } else {
                    echo "</br><form method='post' action='../novo'>
                        <input type='submit'value='Voltar'></input>
                    </form>";
                }
                ?>
            </fieldset>
        </div>
    </div>
    <?php include "rodape.php" ?>
</body>