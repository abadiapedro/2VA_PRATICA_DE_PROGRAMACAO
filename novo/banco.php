<?php

$bdServidor = '127.0.0.1';
$bdUsuario = 'root';
$bdSenha = '';
$bdBanco = 'banco';
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if ($conexao->connect_errno) {
    echo "Problemas para conectar no banco. Verifique os dados!";
    die();
}

function gravar_tarefa($conexao, $tarefa){
    $sqlGravar = "
    INSERT INTO bancaria
       (nome, cpf, endereco, agencia, valor)
       VALUES
       (
           '{$tarefa['nome']}',
           '{$tarefa['cpf']}',
           '{$tarefa['endereco']}',
           '{$tarefa['agencia']}',
           '{$tarefa['valor']}'
       )
    ";

    mysqli_query($conexao, $sqlGravar);
    echo $sqlGravar;
}



function buscar_tarefas($conexao)
{
    $sqlBusca = 'SELECT * FROM bancaria';
    $resultado = mysqli_query($conexao, $sqlBusca);
    $tarefas = array();
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        $tarefas[] = $tarefa;
    }
    return $tarefas;
}

function buscar_tarefa($conexao, $id) {
    $sqlBusca = 'SELECT * FROM bancaria WHERE id = ' . $id; 
    $resultado = mysqli_query($conexao, $sqlBusca);
    
    return mysqli_fetch_assoc($resultado);
}

function buscar_cpf($conexao, $cpf) {
    $sqlBusca = 'SELECT * FROM bancaria WHERE cpf = ' . $cpf; 
    $resultado = mysqli_query($conexao, $sqlBusca);
    
    return mysqli_fetch_assoc($resultado);
}

/*function editar_tarefa($conexao, $tarefa) {
    $sqlEditar = "
    UPDATE bancaria SET
    nome = '{$tarefa['nome']}',
    cpf = '{$tarefa['cpf']}', 
    endereco = '{$tarefa['endereco']}', 
    agencia = '{$tarefa['agencia']}',
    valor = '{$tarefa['valor']}'
    WHERE id = {$tarefa['id']} ";
    mysqli_query($conexao, $sqlEditar); 
}*/
function movimentacao($conexao, $tarefa, $saque) {
    $sqlEditar = "
    UPDATE bancaria SET
    valor = '{$saque['resultado']}'
    WHERE id = {$tarefa['id']} ";
    mysqli_query($conexao, $sqlEditar); 
}

function transferir($conexao,$tarefa,$saque) {
    $sqlTransferirsai = "
    UPDATE bancaria SET
    valor = '{$saque['resultadosai']}'
    WHERE id = {$tarefa['id']}";
    mysqli_query($conexao,$sqlTransferirsai);
    $sqlTransferirentra = "
    UPDATE bancaria SET
    valor = '{$saque['resultadoentra']}'
    WHERE cpf = {$saque['cpfd']}";
    mysqli_query($conexao,$sqlTransferirentra);
}

function remover_tarefa($conexao, $id) {
    $sqlRemover = "DELETE FROM bancaria WHERE id = {$id}";
    mysqli_query($conexao, $sqlRemover);
}

function pesquisa($conexao,$mostrar){
    $sqlPesquisa = "SELECT * from bancaria WHERE nome like '%{$mostrar['nome']}%'";
    mysqli_query($conexao, $sqlPesquisa);
}
?>