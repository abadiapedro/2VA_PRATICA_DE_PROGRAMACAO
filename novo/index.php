<?php

//session_start();


include "banco.php";

$exibir_tabela = true;

if (isset($_GET['nome']) && $_GET['nome'] != '') {

    $tarefa = array();
    $tarefa['nome'] = $_GET['nome'];

    if (isset($_GET['endereco'])) {
        $tarefa['endereco'] = $_GET['endereco'];
    } else {
        $tarefa['endereco'] = '';
    }

    if (isset($_GET['cpf'])) {
        $tarefa['cpf'] = $_GET['cpf'];
    } else {
        $tarefa['cpf'] = '';
    }

    if (isset($_GET['agencia'])) {
        $tarefa['agencia'] = $_GET['agencia'];
    } else {
        $tarefa['agencia'] = '';
    }

    if (isset($_GET['valor'])) {
        $tarefa['valor'] = $_GET['valor'];
    } else {
        $tarefa['valor'] = '';
    }


    gravar_tarefa($conexao, $tarefa);

    header('Location: index.php'); //  leia o manual sobre header
    //  https://www.php.net/manual/pt_BR/function.header.php
    // Location envia um comando ao navegador para
    // redirecionar para a págnia definida após os :
    die();
}

$lista_tarefas = buscar_tarefas($conexao);

$tarefa = array(
    'id' => 0,
    'nome' => '',
    'cpf' => '',
    'endereco' => '',
    'agencia' => '',
    'valor' => ''
);
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>BANCO</title>

</head>

<body>

    <div class="corpo">
        <?php include "menu.php"; ?>
        <h1><a href="index.php">BANCO</a></h1>
        <form class="form">
            <h3>Informe os dados para a criação da sua conta</h3>
            <fieldset>
                <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?> " />
                Nome:
                <input type="text" name="nome" maxlength="20" value="<?php echo $tarefa['nome']; ?>" required><br>
                Endereço:
                <input type="text" name="endereco" value="<?php echo $tarefa['endereco']; ?>"><br>
                CPF:
                <input type="text" name="cpf" maxlength="11" value="<?php echo $tarefa['cpf']; ?>"><br>
                Agencia:
                <input type="text" name="agencia" maxlength="8" value="<?php echo $tarefa['agencia']; ?>"><br>
                Valor:
                <input type="number" name="valor" value="<?php echo $tarefa['valor']; ?>" required><br>
                <br>
                <input type="submit" <?php echo ($tarefa['id'] > 0) ? 'value= "OK"' : 'value="Cadastrar"'; ?> />
                <input type="button" value="Cancelar" onclick="history.go(0)"><br />
            </fieldset>
        </form>
        <?php if ($exibir_tabela) : ?>
            <fieldset>
                <h2>Lista contas banco</h2>
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Número conta</th>
                        <th>Número Agencia</th>
                        <th>Valor</th>
                        <th>Operações</th>
                    </tr>
                    <?php foreach ($lista_tarefas as $tarefa) : ?>
                        <tr>
                            <td> <?php echo $tarefa['nome']; ?> </td>
                            <td> <?php echo $tarefa['cpf']; ?> </td>
                            <td> <?php echo ($tarefa['endereco']); ?> </td>
                            <td> <?php echo ($tarefa['id']); ?> </td>
                            <td> <?php echo ($tarefa['agencia']); ?> </td>
                            <td> R&dollar; <?php echo ($tarefa['valor']); ?> </td>
                            <td>
                                <a href="saque.php?id=<?php echo $tarefa['id']; ?>">|  Saque |</a>
                                <a href="deposito.php?id=<?php echo $tarefa['id']; ?>">| Deposito |</a>
                                <a href="transferir.php?id=<?php echo $tarefa['id']; ?>">| Transferência |</a>
                                <a href="remover.php?id=<?php echo $tarefa['id']; ?>">| Remover |</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            </fieldset>
    </div>
    <?php include "rodape.php" ?>
</body>