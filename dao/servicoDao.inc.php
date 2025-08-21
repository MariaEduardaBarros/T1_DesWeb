<?php
require_once 'conexao.inc.php';
require_once '../classes/servico.inc.php';
require_once '../utils/funcoesUteis.php';

class ServicoDao {
    private $conn;

    public function __construct()
        {
            $c = new Conexao();
            $this->conn = $c->getConexao();
        }

    public function inserirServico(Servico $servico) { // insere um novo serviço no banco de dados
        $sql = $this->conn->prepare("INSERT INTO servicos (nome, valor, descricao, id_tipo) VALUES (:nome, :valor, :descricao, :tipo_servico)");
        $sql->bindValue(':nome', $servico->getNome());
        $sql->bindValue(':valor', $servico->getValor());
        $sql->bindValue(':descricao', $servico->getDescricao());
        $sql->bindValue(':tipo_servico', $servico->getTipoServico());
        return $sql->execute();
    }

    public function buscarServicoPorId($id_servico) { // busca um serviço pelo id
        $sql = $this->conn->prepare("SELECT * FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);
        $servico = new Servico();   
        $servico->setId($id_servico);
        $servico->setServico($row->nome, $row->descricao, $row->valor, $row->id_tipo);

        $datas = $this->buscarDatasPorServicoId($id_servico);
        $servico->setDatasServico($datas);

        return $servico;
    }

    public function listarServicos() { // lista todos os serviços
        $sql = $this->conn->query("SELECT * FROM servicos");
        $servicos = array();
        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $servico = new Servico();   
            $servico->setId($row->id_servico);
            $servico->setServico($row->nome, $row->descricao, $row->valor, $row->id_tipo);
            $datas = $this->buscarDatasPorServicoId($row->id_servico);
            $servico->setDatasServico($datas);
            $servicos[] = $servico;
        }
        return $servicos;
    }

    public function deletarServico($id_servico) { // deleta um serviço pelo id
        $this->deletarDatasPorServicoId($id_servico); // deleta as datas associadas ao serviço
        $sql = $this->conn->prepare("DELETE FROM servicos WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        return $sql->execute();
    }

    public function atualizarServico(Servico $servico) { // atualiza os dados do serviço
        $sql = $this->conn->prepare("UPDATE servicos SET nome = :nome, valor = :valor, descricao = :descricao, id_tipo = :tipo_servico WHERE id_servico = :id_servico");
        $sql->bindValue(':nome', $servico->getNome());
        $sql->bindValue(':valor', $servico->getValor());
        $sql->bindValue(':descricao', $servico->getDescricao());
        $sql->bindValue(':tipo_servico', $servico->getTipoServico());
        $sql->bindValue(':id_servico', $servico->getId());
        return $sql->execute();
    }

    public function inserirDatas(Servico $servico, $datas) {
        $datas_timestamp = $servico->setDatasServico($datas);
        $this->deletarDatasPorServicoId($servico->getId()); // limpa as datas existentes
        foreach ($datas_timestamp as $data) { // percorre o array de datas
            $sql = $this->conn->prepare("INSERT INTO datasdisponiveis (data, disponivel, id_servico) VALUES (:data, :disponivel, :id_servico)");
            $sql->bindValue(':data', converteDataMysql($data)); // converte a data para o formato MySQL
            $sql->bindValue(':disponivel', true); // define como disponível
            $sql->bindValue(':id_servico', $servico->getId());
            $sql->execute();
        }
        return true;
    }

    public function buscarDatasPorServicoId($id_servico) { // busca as datas de um serviço
        $sql = $this->conn->prepare("SELECT data FROM datasdisponiveis WHERE id_servico = :id_servico AND disponivel = 1");
        $sql->bindValue(':id_servico', $id_servico);
        $sql->execute();
        $datas = array();
        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $datas[] = $row->data;
        }
        return $datas;
    }

    public function deletarDatasPorServicoId($id_servico) { // deleta as datas associadas a um serviço
        $sql = $this->conn->prepare("DELETE FROM datasdisponiveis WHERE id_servico = :id_servico");
        $sql->bindValue(':id_servico', $id_servico);
        return $sql->execute();
    }

    public function editarDatasDisponiveis($id_servico, $data) { // atualiza as datas disponíveis de um serviço
        $sql = $this->conn->prepare("UPDATE datasdisponiveis SET disponivel = 0 WHERE id_servico = :id_servico AND data = :data");

        $sql->bindValue(':id_servico', $id_servico);
        $sql->bindValue(':data', converteDataMysql($data));
        $sql->execute();
    }

    public function verificarDisponibilidadeServico($idServico){
        $sql = $this->conn->prepare("SELECT COUNT(*) as qtd FROM datasdisponiveis WHERE id_servico = :id AND disponivel = 1");
        $sql->bindValue(':id', $idServico);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);

        if($row->qtd == 0){
            return false;
        }

        return true;
    }

}

?>