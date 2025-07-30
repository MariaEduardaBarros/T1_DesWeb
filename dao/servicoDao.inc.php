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

    public function buscarServicoPorId($id_servico) {
        $sql = $this->conn->prepare("SELECT * FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);
        $servico = new Servico();   
        $servico->setId($id_servico);
        $servico->setServico($row->nome, $row->descricao, $row->valor, $row->id_tipo);
        $servico->setDataServico($row->data_servico);
        return $servico;
    }

    public function listarServicos() {
        $sql = $this->conn->query("SELECT * FROM servicos");
        $servicos = array();
        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $servico = new Servico();   
            $servico->setId($row->id_servico);
            $servico->setServico($row->nome, $row->descricao, $row->valor, $row->id_tipo);
            $servico->setDataServico($row->data_servico);
            $servicos[] = $servico;
        }
        return $servicos;
    }

    public function deletarServico($id_servico) {
        $sql = $this->conn->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        return $sql->execute();
    }

    public function atualizarServico(Servico $servico) {
        $sql = $this->conn->prepare("UPDATE servicos SET nome = :nome, valor = :valor, descricao = :descricao, id_tipo = :tipo_servico WHERE id_servico = :id_servico");
        $sql->bindValue(':nome', $servico->getNome());
        $sql->bindValue(':valor', $servico->getValor());
        $sql->bindValue(':descricao', $servico->getDescricao());
        $sql->bindValue(':tipo_servico', $servico->getTipoServico());
        $sql->bindValue(':id_servico', $servico->getId());
        return $sql->execute();
    }

    public function inserirDatas(Servico $servico, $datas) {
        foreach ($datas as $data) {
            $sql = $this->conn->prepare("INSERT INTO datasdisponiveis (data, disponivel, id_disponibilidade, id_servico) VALUES (:id_servico, :data)");
            $sql->bindValue(':id_servico', $servico->getId());
            $sql->bindValue(':data', $data);
            if (!$sql->execute()) {
                return false;
            }
        }
        return true;
    }
}

?>