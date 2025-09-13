<?php
require_once(__DIR__ . "/../../model/Aluno.php");
require_once(__DIR__ . "/../../model/Curso.php");
require_once(__DIR__ . "/../../controller/AlunoController.php");

$msgErro = "";
$aluno = null;

if(isset($_POST['nome'])) {
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $idade = is_numeric($_POST['idade']) ? $_POST['idade'] : null;
    $estrangeiro = trim($_POST['estrang']) ? trim($_POST['estrang']) : null; 
    $idCurso = is_numeric($_POST['curso']) ? $_POST['curso'] : null;

    $aluno = new Aluno();
    $aluno->setId(0);
    $aluno->setNome($nome);
    $aluno->setIdade($idade);
    $aluno->setEstrangeiro($estrangeiro);

    $curso = new Curso();
    $curso->setId($idCurso);

    $aluno->setCurso($curso);

    $alunoCont = new AlunoController();
    $erros = $alunoCont->inserir($aluno);

    if(!$erros) {
        header("location: listar.php");
    } else {
        $msgErro = implode("<br>", $erros);
    }
}

include_once(__DIR__ . "/form.php");
?>