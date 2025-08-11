<?php
include_once "conexao.inc.php";
include_once "../classes/usuario.inc.php";

class UsuarioDao
{
    private $conexao;

    public function __construct()
    {
        $c = new Conexao();
        $this->conexao = $c->getConexao();
    }

    function autenticar($email, $senha)
    {
        $sql = $this->conexao->prepare("select * from usuarios where Email = :email AND Senha = :senha");
        $sql->bindValue(":email", strtolower($email));
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount() == 1) {
            return $sql->fetch(PDO::FETCH_OBJ);
        }

        return null;
    }


    public function listarUsuarios(): array
    {
        $stmt = $this->conexao->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    //inserir usuário
    public function inserirUsuario(Usuario $usuario): bool
    {
        $sql = $this->conexao->prepare("
        INSERT INTO usuarios (Nome, Email, is_admin, Endereco, Telefone, CPF, DtNascimento, Senha)
        VALUES (:nome, :email, :is_admin, :endereco, :telefone, :cpf, :dtNascimento, :senha)
    ");
        $sql->bindValue(':nome', $usuario->getNome());
        $sql->bindValue(':email', $usuario->getEmail());
        $sql->bindValue(':is_admin', $usuario->getAdmin(), PDO::PARAM_INT);
        $sql->bindValue(':endereco', $usuario->getEndereco());
        $sql->bindValue(':telefone', $usuario->getTelefone());
        $sql->bindValue(':cpf', $usuario->getCpf());
        $sql->bindValue(':dtNascimento', $usuario->getDtNascimento());
        $sql->bindValue(':senha', $usuario->getSenha());

        return $sql->execute();
    }
}
