<?php
require_once(__DIR__ . "/../../controller/CursoController.php");
$cursoCont = new CursoController();
$cursos = $cursoCont->listar();

include_once(__DIR__ . "/../include/header.php");
?>

<h3><?= $aluno && $aluno->getId() > 0 ? "Alterar" : "Inserir"?> aluno</h3>

<div class="row">

    <div class="col-6">

        <form method="POST" action="">

            <div>
                <label class="form-label" for="txtNome">Nome: </label>
                <input class="form-control" type="text" name="nome" id="txtNome" placeholder="informe o nome..." value="<?= $aluno ? $aluno->getNome() : '' ?>">
            </div>

            <div>
                <label class="form-label" for="numIdade">Idade: </label>
                <input class="form-control" type="number" name="idade" id="numIdade" placeholder="informe a idade..." value="<?= $aluno ? $aluno->getIdade() : null ?>">
            </div>

            <div>
                <label class="form-label" for="selEstrang">Estrangeiro? </label>
                <select class="form-select" id="selEstrang" name="estrang">
                    <option value="">selecione...</option>
                    <option value="S" <?= $aluno && $aluno->getEstrangeiro() === 'S' ? 'selected' : '' ?>>Sim</option>
                    <option value="N" <?= $aluno && $aluno->getEstrangeiro() === 'N' ? 'selected' : '' ?>>Não</option>  
                </select>
            </div>

            <div>
                <label class="form-label" for="selCurso">Curso: </label>
                <select class="form-select" id="selCurso" name="curso">
                    <option value="">selecione...</option>
                    <?php foreach($cursos as $curso): ?>
                        <option value="<?= $curso->getId() ?>" <?= $aluno && $aluno->getCurso() && $aluno->getCurso()->getId() === $curso->getId() ? 'selected' : '' ?>><?= $curso ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?= $aluno ? $aluno->getId() : 0 ?>">

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Gravar</button>
            </div>

        </form>

    </div>

    <?php if($msgErro): ?>
    <div class="col-6">

        <div class="alert alert-danger">
            <?= $msgErro ?>
        </div>
    
    </div>
    <?php endif ?>

</div>

<div class="mt-3">
    <a class="btn btn-outline-primary" href="listar.php">Voltar</a>
</div>

<?php
include_once(__DIR__ . "/../include/footer.php");
?>