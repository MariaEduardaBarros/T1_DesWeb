<?php
include_once "conexao.inc.php";
include_once "../classes/ItemCarrinho.inc.php";
include_once "../classes/venda.inc.php";
include_once "../utils/funcoesUteis.php";

class VendaDao{
    private $con;

    function __construct(){
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function incluirVenda($venda, $carrinho){
        $sql = $this->con->prepare("insert into vendas (Cod_cliente, Valor_Total, Data_Venda) values (:codCli, :total, :dtVenda)");

        $sql->bindValue(":codCli", $venda->getCod_cliente());
        $sql->bindValue(":dtVenda", converteDataMysql($venda->getData()));
        $sql->bindValue(":total", $venda->getValorTotal());
        $sql->execute();

        $this->incluirItens($this->getIdVenda(), $carrinho);
    }

    public function incluirItens($idVenda, $carrinho){
        foreach($carrinho as $item){
            $sql = $this->con->prepare("insert into itens (id_servico, valor_total, id_venda) values (:idServico,  :val, :idV)");

            $sql->bindValue(":idServico", $item->getId());
            $sql->bindValue(":val", $item->getValor());
            $sql->bindValue(":idV", $idVenda);
            $sql->execute();
        }
    }

    public function getIdVenda(){
        $sql = $this->con->query("select MAX(Cod_Venda) as maior from vendas");

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row->maior;
    }
}
?>