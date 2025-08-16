<?php
require_once "../classes/servico.inc.php";

class ItemCarrinho {
    private Servico $servico;

    public function __construct(Servico $servico) {
        $this->servico = $servico;
    }

    public function getServico() {
        return $this->servico;
    }

}


?>