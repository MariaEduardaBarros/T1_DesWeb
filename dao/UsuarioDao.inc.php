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

    public function autenticar($email, $senha) {
        $sql = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email and senha = :senha");
        
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();
        
        $usuario = NULL;
        if($sql->rowCount() == 1){ //Garante que um usuario foi encontrado
            $usuario = $sql->fetch(PDO::FETCH_OBJ);
        }
        return $usuario;
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
            $row->tipo,
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
        INSERT INTO usuarios (Nome, Email, tipo, Endereco, Telefone, CPF, DtNascimento, Senha)
        VALUES (:nome, :email, :tipo, :endereco, :telefone, :cpf, :dtNascimento, :senha)
    ");
        $sql->bindValue(':nome', $usuario->getNome());
        $sql->bindValue(':email', $usuario->getEmail());
        $sql->bindValue(':tipo', $usuario->getTipo(), PDO::PARAM_INT);
        $sql->bindValue(':endereco', $usuario->getEndereco());
        $sql->bindValue(':telefone', $usuario->getTelefone());
        $sql->bindValue(':cpf', $usuario->getCpf());
        $sql->bindValue(':dtNascimento', $usuario->getDtNascimento());
        $sql->bindValue(':senha', $usuario->getSenha());

        return $sql->execute();
    }

    // Buscar usuário por CodCli
public function buscarUsuarioPorId($codCli)
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
            $row->tipo,
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
public function atualizarUsuario(Usuario $usuario){
    $sql = $this->conexao->prepare("UPDATE usuarios SET Nome = :nome, Email = :email, Telefone = :telefone, CPF = :cpf, DtNascimento = :dtNascimento, Endereco = :endereco, tipo = :tipo WHERE CodCli = :codCli");

    $sql->bindValue(':nome', $usuario->getNome());
    $sql->bindValue(':email', $usuario->getEmail());
    $sql->bindValue(':telefone', $usuario->getTelefone());
    $sql->bindValue(':cpf', $usuario->getCpf());
    $sql->bindValue(':dtNascimento', $usuario->getDtNascimento());
    $sql->bindValue(':endereco', $usuario->getEndereco());
    $sql->bindValue(':tipo', $usuario->getTipo());
    $sql->bindValue(':codCli', $usuario->getId());

    if($sql->execute()){ //Garante que um usuario foi atualizado
        $busca = $this->conexao->prepare("SELECT * FROM usuarios WHERE CodCli = :codCli");
        $busca->bindValue(':codCli', $usuario->getId());
        $busca->execute();
        return $busca->fetch(PDO::FETCH_OBJ);
    }
    return false;
}

// Excluir usuário
public function excluirUsuario($codCli): bool
{
    $sql = $this->conexao->prepare("DELETE FROM usuarios WHERE CodCli = :codCli");
    $sql->bindValue(':codCli', $codCli, PDO::PARAM_INT);
    return $sql->execute();
}

public function buscarUsuarioPorEmail($email) {
        $sql = $this->conexao->prepare("SELECT * FROM usuarios WHERE Email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        $dados = $sql->fetch(PDO::FETCH_ASSOC);
        if($dados) {
            $usuario = new Usuario();
            $usuario->setUsuario(
                $dados['CodCli'],
                $dados['Nome'],
                $dados['Email'],
                $dados['tipo'],
                $dados['Endereco'],
                $dados['Telefone'],
                $dados['CPF'],
                $dados['DtNascimento'],
                $dados['Senha']
            );
            return $usuario;
        }
        return null;
}

public function atualizarSenha($email, $senha) {
    $sql = $this->conexao->prepare("UPDATE usuarios SET Senha = :senha WHERE Email = :email");
    $sql->bindValue(':senha', $senha);
    $sql->bindValue(':email', $email);
    return $sql->execute();
}

}
?>