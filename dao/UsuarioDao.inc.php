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

    public function buscarUsuarioPorEmailSenha($email, $senha) {
    $sql = "SELECT * FROM usuarios WHERE Email = :email AND Senha = :senha";
    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':senha', $senha);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $usuario = new Usuario();
        $usuario->setUsuario(
            $row['CodCli'],
            $row['Nome'],
            $row['Email'],
            $row['is_admin'],
            $row['Endereco'],
            $row['Telefone'],
            $row['CPF'],
            $row['DtNascimento'],
            $row['Senha']
        );
        return $usuario;
    }
    return null;
}

    public function getLastInsertId() {
    return $this->conexao->lastInsertId();
}


    public function listarUsuarios(): array {
    $stmt = $this->conexao->query("SELECT * FROM usuarios");
    $usuarios = [];
    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
        $usuario = new Usuario();
        $usuario->setUsuario(
            $row->CodCli,
            $row->Nome,
            $row->Email,
            $row->is_admin,
            $row->Endereco,
            $row->Telefone,
            $row->CPF,
            $row->DtNascimento,
            $row->Senha
        );
        $usuarios[] = $usuario;
    }
    return $usuarios;
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

    // Buscar usuário por CodCli
public function buscarUsuarioPorId($codCli): ?Usuario
{
    $sql = $this->conexao->prepare("SELECT * FROM usuarios WHERE CodCli = :codCli");
    $sql->bindValue(':codCli', $codCli, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_OBJ);

    if ($row) {
        $usuario = new Usuario();
        $usuario->setUsuario(
            $row->CodCli,
            $row->Nome,
            $row->Email,
            $row->is_admin,
            $row->Endereco,
            $row->Telefone,
            $row->CPF,
            $row->DtNascimento,
            $row->Senha
        );
        return $usuario;
    }
    return null;
}

// Atualizar usuário
public function atualizarUsuario(Usuario $usuario): bool
{
    $sql = $this->conexao->prepare("
        UPDATE usuarios SET 
            Nome = :nome,
            Email = :email,
            Telefone = :telefone,
            CPF = :cpf,
            DtNascimento = :dtNascimento,
            Endereco = :endereco,
            is_admin = :is_admin
        WHERE CodCli = :codCli
    ");

    $sql->bindValue(':nome', $usuario->getNome());
    $sql->bindValue(':email', $usuario->getEmail());
    $sql->bindValue(':telefone', $usuario->getTelefone());
    $sql->bindValue(':cpf', $usuario->getCpf());
    $sql->bindValue(':dtNascimento', $usuario->getDtNascimento());
    $sql->bindValue(':endereco', $usuario->getEndereco());
    $sql->bindValue(':is_admin', $usuario->getAdmin(), PDO::PARAM_INT);
    $sql->bindValue(':codCli', $usuario->getId(), PDO::PARAM_INT); // o getId deve pegar CodCli
    return $sql->execute();
}

// Excluir usuário
public function excluirUsuario($codCli): bool
{
    $sql = $this->conexao->prepare("DELETE FROM usuarios WHERE CodCli = :codCli");
    $sql->bindValue(':codCli', $codCli, PDO::PARAM_INT);
    return $sql->execute();
}

}

?>