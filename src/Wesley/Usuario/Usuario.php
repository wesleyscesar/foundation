<?php

namespace Wesley\Usuario;

use Wesley\Config\Conexao;

class Usuario
{

    private $conn;
    private $id;
    private $login;
    private $senha;

    public function __construct(Conexao $conexao)
    {
        $this->conn = $conexao->getConexao();
    }

    public function autenticar($login,$senha){
        $query = "SELECT * FROM usuarios WHERE login = :login and senha = :senha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        return $stmt->rowCount();

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

}
