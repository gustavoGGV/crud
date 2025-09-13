<?php

require_once(__DIR__ . "/../../model/Curso.php");
require_once(__DIR__ . "/../../controller/AlunoController.php");

$msgErro = "";
$aluno = null;

if(isset($_POST["nome"])) {
    $id = $_POST["id"];
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $idade = is_numeric($_POST['idade']) ? $_POST['idade'] : null;
    $estrangeiro = trim($_POST['estrang']) ? trim($_POST['estrang']) : null; 
    $idCurso = is_numeric($_POST['curso']) ? $_POST['curso'] : null;

    $aluno = new Aluno();
    $aluno->setId($id);
    $aluno->setNome($nome);
    $aluno->setIdade($idade);
    $aluno->setEstrangeiro($estrangeiro);

    if($idCurso) {
        $curso = new Curso();
        $curso->setId($idCurso);
        $aluno->setCurso($curso);
    } else {
        $aluno->setCurso(null);
    }

    $alunoCont = new AlunoController();
    $erros = $alunoCont->alterar($aluno);

    if(!$erros) {
        header("location: listar.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }
} else {
    $id = 0;
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }

    $alunoCont = new AlunoController();
    $aluno = $alunoCont->buscarPorId($id);

    if(!$aluno) {
        echo "O ID do aluno é inválido!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }
}

include_once(__DIR__ . "/form.php");
