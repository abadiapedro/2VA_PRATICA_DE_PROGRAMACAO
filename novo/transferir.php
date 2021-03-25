<?php

session_start();

include "banco.php";

$saque = array(
    'valoredit' => '',
    'resultadosai' => '',
    'resultadoentra' => '',
    'nomed' => '',
    'cpfd' =>''
);

$valor_destinatario = '';


/*-----------------------------Sai----------------------*/

if (isset($_GET['nome']) && $_GET['nome'] != '') {
    $tarefa = array();
    $saque = array();
    $saque['valoredit'] = $_GET['valoredit'];

    $tarefa['id'] = $_GET['id'];

    $tarefa['nome'] = $_GET['nome'];

    if (isset($_GET['endereco'])) {
        $tarefa['endereco'] = $_GET['endereco'];
    } else {
        $tarefa['endereco'] = '';
    }

    if (isset($_GET['cpf'])) {
        $tarefa['cpf'] = ($_GET['cpf']);
    } else {
        $tarefa['cpf'] = '';
    }

    if (isset($_GET['agencia'])) {
        $tarefa['agencia'] = ($_GET['agencia']);
    } else {
        $tarefa['agencia'] = '';
    }
    if (isset($_GET['valor'])) {
        $tarefa['valor'] = ($_GET['valor']);
    } else {
        $tarefa['valor'] = '';
    }
    /*-----------------------------Entra----------------------*/
    if (isset($_GET['nomed'])){
        $saque['nomed'] = $_GET['nomed'];
    }else{
        $saque['nomed'] = '';
    }
    if (isset($_GET['cpfd'])) {
        $saque['cpfd'] = ($_GET['cpfd']);
        $aux = buscar_cpf($conexao,$saque['cpfd']);
        $valor_destinatario = $aux['valor'];
    } else {
        $saque['cpfd'] = '';
    }

    if (isset($_GET['valoredit'])&& ($_GET['valoredit']<=$_GET['valor']) && ($_GET['valoredit'] != '')) {
        $saque['resultadoentra'] = $valor_destinatario + $saque['valoredit'];
        $saque['resultadosai'] = $tarefa['valor'] - $saque['valoredit'];
        transferir($conexao,$tarefa,$saque);
        header('Location: index.php');
    } else {
        $saque['valoredit'] = '';
        echo "<script>alert('Você não pode fazer essa operação! Por favor verifique o valor da transferência informado!');
            </script>";
    }
        /*if (isset($_GET['valord'])&& ($_GET['valord']<=$_GET['valor']) && ($_GET['valord'] != '')) {
            $transferir['resultadoentra'] = $tarefa['valor'] - $transferir['valord'];
            //$transferir['resultadosai'] = $tarefa['valor'] - $transferir['valord'];
            echo $transferir['resultadoentra'];
            //echo $transferir['resultadosai'];
            transferir($conexao, $tarefa, $transferir);
            //header('Location: index.php');
        } else {
            $transferir['valord'] = '';
            echo "<script>alert('Você não pode fazer essa operação! Por favor verifique o valor informado no campo [Valor a ser transferido]!');
        </script>";
        }*/
    }

$tarefa = buscar_tarefa($conexao, $_GET['id']);




?>
<html>

<head>
    <meta charset="utf-8" />
    <title>BANCO</title>
    <link rel="stylesheet" href="tarefas.css" type="text/css" />
</head>

<body>
    <div class="corpo">
        <?php include "menu.php" ?>
        <h1><a href="index.php">BANCO</a></h1>
        <form class="form">
        <h3>Operação Bancaria >> Transferência</h3>
            <fieldset>
                <h2>Seus dados</h2>
                <input type="hidden" readonly name="id" value="<?php echo $tarefa['id']; ?> " />
                Nome:
                <input type="text" readonly name="nome" value="<?php echo $tarefa['nome']; ?>"><br>
                Endereço:
                <input type="text" readonly name="endereco" value="<?php echo $tarefa['endereco']; ?>"><br>
                CPF:
                <input type="number" readonly name="cpf" value="<?php echo $tarefa['cpf']; ?>"><br>
                Agencia:
                <input type="number" readonly name="agencia" value="<?php echo $tarefa['agencia']; ?>"><br>
                Valor:
                <input type="text" readonly name="valor" value="<?php echo $tarefa['valor']; ?>">
            </fieldset>
            <br>
            <fieldset>
                <h2>Dados para transferência</h2>
                Nome:
                <input type="text" name="nomed"><br>
                CPF:
                <input type="number" name="cpfd"><br>
            </fieldset>
            <br>
            <fieldset>
                <h2>Valor a ser transferido:</h2>
                <input type="text" name="valoredit">
            
            <br><br>
            <input type="submit" <?php echo ($tarefa['id'] > 0) ? 'value= "Transferir"' : 'value="Cadastrar"'; ?> />
            <input type="button" value="Voltar" onclick="window.location.href='../novo'">
            </fieldset>
        </form>
    </div>
</body>
<?php include "rodape.php" ?>

</html>