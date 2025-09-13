<?php
require_once(__DIR__ . "/../../controller/AlunoController.php");

$alunoCont = new AlunoController();
$lista = $alunoCont->listar();

include_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de alunos</h3>

<div>
    <a class="btn btn-outline-primary" href="inserir.php">Inserir</a>
</div>

<table class="table table-striped mt-3">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Estrangeiro</th>
        <th>Curso</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach($lista as $aluno): ?>
        <tr>
            <td>
                <?= $aluno->getId() ?>
            </td>
            <td>
                <?= $aluno->getNome() ?>
            </td>
            <td>
                <?= $aluno->getIdade() ?>
            </td>
            <td>
                <?= $aluno->getEstrangeiroTexto() ?>
            </td>
            <td>
                <?= $aluno->getCurso()->getNome() . " (" . $aluno->getCurso()->getTurnoTexto() . ")" ?>
            </td>
            <td>
                <a href="alterar.php?id=<?= $aluno->getId() ?>"><img src="../../img/btn_editar.png"></a>
            </td>
            <td>
                <a href="excluir.php?id=<?= $aluno->getId() ?>" onclick="return confirm('Confirma a exclusão do aluno <?= $aluno->getNome() ?>?')"><img src="../../img/btn_excluir.png"></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php

include_once(__DIR__ . "/../include/footer.php")

?>
