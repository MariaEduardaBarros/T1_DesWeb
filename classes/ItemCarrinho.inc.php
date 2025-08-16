<?php
require_once "../classes/servico.inc.php";

class ItemCarrinho {
    private Servico $servico;
    private $data;

    public function __construct(Servico $servico, $data) {
        $this->servico = $servico;
        $this->data = $data; 
    }

    public function getServico() {
        return $this->servico;
    }

    public function setData($data) {
        $this->data = strtotime($data); // converte a data para timestamp
    }

    public function getData() {
        return $this->data;
    }

}


?>