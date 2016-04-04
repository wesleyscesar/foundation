<?php

namespace Wesley\Config;

class Fixtures{

    private $conn;

    public function __construct(Conexao $conexao)
    {
        $this->conn = $conexao->getConexao();
        $this->persist();
    }

    private function persist()
    {

        # REMOVENDO A TABELA USUARIOS
        $this->conn->query("DROP TABLE IF EXISTS usuarios");

        # CRIANDO A TABELA USUARIOS
        $this->conn->query("CREATE TABLE usuarios (
                  id INT NOT NULL AUTO_INCREMENT,
                  login VARCHAR(50),
                  senha VARCHAR(50),
                  PRIMARY KEY (id));"
        );


        # INSERINDO INFORMAÇOES NA TABELA USUARIOS

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


###############################################################################################################


        # REMOVENDO A TABELA ROTAS
        $this->conn->query("DROP TABLE IF EXISTS rotas");

        # CRIANDO A TABELA USUARIOS
        $this->conn->query("CREATE TABLE rotas (
                  id INT NOT NULL AUTO_INCREMENT,
                  rota VARCHAR(50),
                  conteudo VARCHAR(250),
                  PRIMARY KEY (id));"
        );


        # INSERINDO INFORMAÇOES NA TABELA USUARIOS

        $rotas = array(
            0 => array("id" => 1, "rota" => "home", "conteudo" => "Pagina Home"),
            1 => array("id" => 2, "rota" => "empresa", "conteudo" => "<p>Pagina Empresa</p>"),
            2 => array("id" => 3, "rota" => "produto", "conteudo" => "Pagina Produtos"),
            3 => array("id" => 4, "rota" => "servico", "conteudo" => "Pagina Servicos"),
            4 => array("id" => 5, "rota" => "contato", "conteudo" => "Pagina Contato"),
            5 => array("id" => 6, "rota" => "fixtures", "conteudo" => "Fixtures"),
            6 => array("id" => 7, "rota" => "autenticacao", "conteudo" => "Pagina Autenticacao")
        );


        foreach ($rotas as $rota) {

            $query = "Insert into rotas(rota, conteudo) values(:rota, :conteudo)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':rota', $rota['rota']);
            $stmt->bindValue(':conteudo', $rota['conteudo']);
            $stmt->execute();

        }


    }

}
