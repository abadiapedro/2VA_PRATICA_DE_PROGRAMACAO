<html>
    <head>
        <meta charset="utf-8" />
        <title>Listagem de Tarefas</title>
        <link rel="stylesheet" href="tarefas.css" type="text/css" />
    </head>
    
</html>

<?php

session_start();
$exibir_tabela = true;

include "banco.php";

$mostrar = array(
    'id' => 0,
    'nome' => '',
    'cpf' => '',
    'endereco' => '',
    'agencia' => '',
    'valor' => ''
);

if(isset($_GET['pesquisa'])&& ($_GET['pesquisar'] != "")){
    $mostrar['nome'] = $_GET['nome'];
    pesquisa($conexao,$mostrar);
}

if ($exibir_tabela) : ?>

<div class="corpo">
<?php include "menu.php"; ?>
<h1><a href="index.php">BANCO</a></h1>
    <fieldset>
    <h2>Pesquisa</h2>
    <div class="pesquisa">
            Pesquisar:
            <input type="text" name="pesquisa" size="20" maxlength="5" value="<?php echo $mostrar['nome']; ?>"/>
            <input type="submit" value="OK">
        </div>
        <br><br>
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>Numero conta</th>
            <th>Numero Agencia</th>
            <th>Valor</th>
            <th>Opções</th>
        </tr>
        <?php foreach ($lista_tarefas as $mostrar) : ?>
            <tr>
                <td> <?php echo $mostrar['nome']; ?> </td>
                <td> <?php echo $mostrar['cpf']; ?> </td>
                <td> <?php echo ($mostrar['endereco']); ?> </td>
                <td> <?php echo ($mostrar['id']); ?> </td>
                <td> <?php echo ($mostrar['agencia']); ?> </td>
                <td> <?php echo ($mostrar['valor']); ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</fieldset>
</div>
<?php include "rodape.php" ?>