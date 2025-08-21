<?php 

class Venda{
    private $id_venda;
    private $cod_cliente;
    private $valorTotal;
    private $data;

    public function __construct($cod_cliente, $valor){
        $this->cod_cliente = $cod_cliente;
        $this->valorTotal = $valor;
        $this->data = time();
    }

    public function getIdVenda(){
        return $this->id_venda;
    }

    public function setCod_cliente($cod_cliente){
        $this->cod_cliente = $cod_cliente;
    }

    public function getCod_cliente(){
        return $this->cod_cliente;
    }

    public function setValorTotal($valor){
        $this->valorTotal = $valor;
    }

    public function getValorTotal(){
        return $this->valorTotal;
    }

    public function getData(){
        return $this->data;
    }

}
?>