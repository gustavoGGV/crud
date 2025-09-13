<?php

require_once(__DIR__ . "/../../controller/AlunoController.php");

$alunoCont = new AlunoController;
$id = 0;

if(isset($_GET["id"])) {
    $id = $_GET["id"];
}

$aluno = $alunoCont->buscarPorId($id);
if($aluno) {
    // Pode-se usar a variável $id também.
    $erros = $alunoCont->excluirPorId($aluno->getId());

    if($erros) {
        $msgErros = implode("<br>", $erros);
        echo $msgErros;
    } else {
        header("location: listar.php");
        exit;
    }
} else {
    echo "Aluno não encontrado!<br>";
    echo "<a href='listar.php'>Voltar</a>";
}
