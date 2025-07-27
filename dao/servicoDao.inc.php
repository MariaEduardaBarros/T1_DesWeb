<?php
include_once 'conexao.inc.php';
include_once '../classes/servico.inc.php';

class ServicoDao {
    private $conn;

    public function __construct()
        {
            $c = new Conexao();
            $this->conn = $c->getConexao();
        }

    public function inserirServico(Servico $servico) {
        $sql = $this->conn->prepare("INSERT INTO servicos (nome, valor, descricao, id_tipo) VALUES (:nome, :valor, :descricao, :tipo_servico)");
        $sql->bindValue(':nome', $servico->getNome());
        $sql->bindValue(':valor', $servico->getValor());
        $sql->bindValue(':descricao', $servico->getDescricao());
        $sql->bindValue(':tipo_servico', $servico->getTipoServico());
        return $sql->execute();
    }

    public function buscarServicoPorId($id) {
        $sql = $this->conn->prepare("SELECT * FROM servicos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarServicos() {
        $sql = $this->conn->query("SELECT * FROM servicos");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletarServico($id_servico) {
        $sql = $this->conn->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        return $sql->execute();
    }
}

?>