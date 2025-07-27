<?php
    include_once "conexao.inc.php";

    class ClienteDao{
        private $conexao;

        public function __construct()
        {
            $c = new Conexao();
            $this->conexao = $c->getConexao();
        }

        function autenticar($email, $senha){
            $sql = $this->conexao->prepare("select * from clientes where Email = :email AND Senha = :senha"); 
            $sql->bindValue(":email", strtolower($email));
            $sql->bindValue(":senha", $senha);  
            $sql->execute();

            $cliente = NULL;
            if($sql->rowCount() == 1){
                $cliente = $sql->fetch(PDO::FETCH_OBJ);     
            }
            
            return $cliente;
        }
    }
?>

