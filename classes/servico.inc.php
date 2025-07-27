<?php
    class Servico {
        private $id;
        private $nome;
        private $descricao;
        private $valor;
        private $tipo_servico;
        private $data_servico = [];

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

        public function getvalor() {
            return $this->valor;
        }

        public function getDataServico() {
            return $this->data_servico;
        }

        public function setDataServico($data) {
            $this->data_servico[] = $data;
        }

        public function getTipoServico() {
            return $this->tipo_servico;
        }
        
    }
?>