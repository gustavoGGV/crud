<?php

require_once(__DIR__ . "/../model/Aluno.php");
require_once(__DIR__ . "/../dao/AlunoDAO.php");
require_once(__DIR__ . "/../service/AlunoService.php");

class AlunoController {
    private AlunoDAO $alunoDAO;
    private AlunoService $alunoService;

    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
        $this->alunoService = new AlunoService();
    }

    public function listar() {
        $lista = $this->alunoDAO->listar();

        return $lista;
    }

    public function buscarPorId(int $id) {
        $aluno = $this->alunoDAO->buscarPorId($id);
        
        return $aluno;
    }
    
    public function inserir(Aluno $aluno) {
        $erros = $this->alunoService->validarAluno($aluno);
        if($erros) {
            return $erros;
        }

        $erro = $this->alunoDAO->inserir($aluno);

        if($erro) {
            array_push($erros, "Erro ao salvar o aluno!");
            if(AMB_DEV) {
                array_push($erros, $erro->getMessage());
            }
        }

        return $erros;
    }

    public function alterar(Aluno $aluno) {
        $erros = $this->alunoService->validarAluno($aluno);
        if($erros) {
            return $erros;
        }

        $erro = $this->alunoDAO->alterar($aluno);

        if($erro) {
            array_push($erros, "Erro ao alterar o aluno!");
            if(AMB_DEV) {
                array_push($erros, $erro->getMessage());
            }
        }

        return $erros;
    }

    public function excluirPorId(int $id) {
        $erros = array();

        $erro = $this->alunoDAO->excluirPorId($id);

        if($erro) {
            array_push($erros, "Erro ao excluir o aluno!");
            if(AMB_DEV) {
                array_push($erros, $erro->getMessage());
            }
        }

        return $erros;
    }
}