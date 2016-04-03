<?php

namespace Wesley\Config;

class Fixtures{

    private $conn;
    private $cliente;

    public function __construct(Conexao $conexao)
    {
        $this->conn = $conexao->getConexao();
        $this->persist();
    }

    private function persist()
    {

        # REMOVENDO A TABELA
        $this->conn->query("DROP TABLE IF EXISTS usuarios");


        # CRIANDO A TABELA
        $this->conn->query("CREATE TABLE usuarios (
                  id INT NOT NULL AUTO_INCREMENT,
                  login VARCHAR(50),
                  senha VARCHAR(50),
                  PRIMARY KEY (id));"
        );


        # INSERINDO INFORMAÇOES

        $usuarios = array(
            0 => array("id" => 1, "login" => "admin", "senha" => "admin"),
            1 => array("id" => 2, "login" => "teste", "senha" => "123")
        );


        foreach ($usuarios as $usuario) {

            $query = "Insert into usuarios(login, senha) values(:login, :senha)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':login', $usuario['login']);
            $stmt->bindValue(':senha', $usuario['senha']);
            $stmt->execute();

        }


    }

}

/*require_once "Conexao.php";

$conn = getConexao();

# REMOVENDO A TABELA
$conn->query("DROP TABLE IF EXISTS rotas;");


# CRIANDO A TABELA
$conn->query("CREATE TABLE rotas (
              id INT NOT NULL AUTO_INCREMENT,
              rota VARCHAR(20),
              titulo VARCHAR(50),
              conteudo VARCHAR(200),
              PRIMARY KEY (id));");


# INSERINDO INFORMAÇOES

$rotas = array(
    0 => array("rota"=>"home", "titulo"=>"Home", "conteudo"=>"Pagina inicial"),
    1 => array("rota"=>"empresa", "titulo"=>"Empresa", "conteudo"=>"Informacoes sobre a pagina empresa"),
    2 => array("rota"=>"contato", "titulo"=>"Contato", "conteudo"=>"form")
);

foreach($rotas as $rota)
{
    $stmt = $conn->prepare("INSERT INTO rotas (rota, titulo, conteudo) VALUES (:rota, :titulo, :conteudo);");
    $stmt->bindParam(":rota", $rota['rota'], PDO::PARAM_STR);
    $stmt->bindParam(":titulo", $rota['titulo'], PDO::PARAM_STR);
    $stmt->bindParam(":conteudo", $rota['conteudo'], PDO::PARAM_STR);
    $stmt->execute();
}*/