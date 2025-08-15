<?php
class Usuario {
    private $CodCli;
    private $nome;
    private $email;
    private $tipo;
    private $endereco;
    private $telefone;
    private $cpf;
    private $dtNascimento;
    private $senha;

    // Método para preencher os dados do usuário
    public function setUsuario($CodCli, $nome, $email, $tipo, $endereco, $telefone, $cpf, $dtNascimento, $senha) {
        $this->CodCli = $CodCli;
        $this->nome = $nome;
        $this->email = $email;
        $this->tipo = $tipo;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->dtNascimento = $dtNascimento;
        $this->senha = $senha;
    }

    // Getters e setters para cada propriedade
    public function getId() {
        return $this->CodCli;
    }

    public function setId($id) {
        $this->CodCli = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getDtNascimento() {
        return $this->dtNascimento;
    }

    public function setDtNascimento($dtNascimento) {
        $this->dtNascimento = $dtNascimento;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }    
}
?>
