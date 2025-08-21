<?php
    class Servico {
        private $id;
        private $nome;
        private $descricao;
        private $valor;
        private $tipo_servico;
        private $data_servico = array();
        private $disponivel;

        public function setServico($nome, $descricao, $valor, $tipo_servico) {
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->valor = $valor;
            $this->tipo_servico = $tipo_servico;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getValor() {
            return $this->valor;
        }

        public function getDataServico() {
            return $this->data_servico;
        }

        public function setDatasServico(array $vetorDeDatas) {
            $this->data_servico = []; 
            foreach ($vetorDeDatas as $data) {
                if (!empty($data)) {
                    $this->data_servico[] = strtotime($data); // converte a data para timestamp
                }
            }
            return $this->data_servico;
        }

        public function getTipoServico() {
            return $this->tipo_servico;
        }

        public function setDisponivel($bool) {
            $this->disponivel = $bool;
        }

        public function getDisponivel() {
            return $this->disponivel;
        }
        
    }
?>