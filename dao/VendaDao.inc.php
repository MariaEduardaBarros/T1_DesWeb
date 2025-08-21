<?php
include_once "conexao.inc.php";
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
    }

    /*public function incluirItens($idVenda, $carrinho){
        foreach($carrinho as $item){
            $sql = $this->con->prepare("insert into itens (id_produto, quantidade, valorTotal, id_venda) values (:idProd, :qtd, :val, :idV)");

            $sql->bindValue(":idProd", $item->getProduto()->getProduto_id());
            $sql->bindValue(":qtd", $item->getQuantidade());
            $sql->bindValue(":val", $item->getValorItem());
            $sql->bindValue(":idV", $idVenda);
            $sql->execute();
        }
    }

    public function getIdVenda(){
        $sql = $this->con->query("select MAX(id_venda) as maior from vendas");

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row->maior;
    }*/
}
?>