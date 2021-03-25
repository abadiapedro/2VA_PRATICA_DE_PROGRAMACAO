<?php

session_start();


include "banco.php";


$saque = array(
    'valoredit' => '',
    'resultado' => ''
);

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

    if (isset($_GET['valoredit']) && ($_GET['valoredit'] != '') && ($_GET['valoredit'] != 0)) {
        $saque['resultado'] = $tarefa['valor'] + $saque['valoredit'];
        movimentacao($conexao, $tarefa, $saque);
        header('Location: index.php');
    } else {
        $tarefa['valor'] = '';
        echo "<script>alert('Valor do deposito não pode ser ZERO ou VAZIO!');
        </script>";
    }
}

$tarefa = buscar_tarefa($conexao, $_GET['id']);
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>BANCO</title>
    <link rel="stylesheet" href="tarefas.css" type="text/css" />
</head>

<div class="corpo">
    <?php include "menu.php" ?>
    <h1><a href="index.php">BANCO</a></h1>
    <form class="form">
        <h3>Operação Bancaria >> Depósito</h3>
        <fieldset>
            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?> " />
            Nome:
            <input type="text" readonly name="nome" value="<?php echo $tarefa['nome']; ?>"><br>
            Endereço:
            <input type="text" readonly name="endereco" value="<?php echo $tarefa['endereco']; ?>"><br>
            CPF:
            <input type="number" readonly name="cpf" value="<?php echo $tarefa['cpf']; ?>"><br>
            Agencia:
            <input type="number" readonly name="agencia" value="<?php echo $tarefa['agencia']; ?>"><br>
            Valor:
            <input type="text" readonly name="valor" value="<?php echo $tarefa['valor']; ?>"><br><br>
            Valor do Deposito:
            <input type="text" name="valoredit" value="<?php echo $saque['valoredit']; ?>">
            <br><br>
            <input type="submit" <?php echo ($tarefa['id'] > 0) ? 'value= "Depositar"' : 'value="Cadastrar"'; ?> /> 
            <input type="button" value="Voltar" onclick="window.location.href='../novo'">
        </fieldset>
    </form>
</div>
<?php include "rodape.php" ?>