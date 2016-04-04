<?php

namespace Wesley\Rota;

use Wesley\Config\Conexao;

class Rota
{
    private $conn;
    private $cont;

    public function getCont()
    {
        return $this->cont;
    }

    public function setCont($cont)
    {
        $this->cont = $cont;
    }


    public function __construct(Conexao $conexao)
    {
        $this->conn = $conexao->getConexao();
    }

    public function getPaginas()
    {
        $query = "select * from rotas";

        $stmt = $this->conn->query($query);

        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $item) {
            echo '<li><a href="administracao.php?id=' . $item['id'] . '">' . $item['rota'] . '</a></li>';
        }

    }

    public function getConteudo($id)
    {

        $query = "select conteudo from rotas where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch();

    }

    public function getPagina($rota)
    {

        $query = "select conteudo from rotas where rota = :rota";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':rota', $rota);
        $stmt->execute();

        return $stmt->fetch();

    }

    public function setConteudo($id)
    {

        $query = "update rotas set conteudo = :conteudo where id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':conteudo', $this->getCont());
        if ($stmt->execute()) {
            return true;
        }
    }

    public function conteudo($str)
    {

        $sql = "SELECT * FROM rotas WHERE conteudo LIKE '%" . $str . "%'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $links = '<ul>';
        foreach ($stmt->fetchAll() as $item) {
            $links .= '<li><a href="' . $item["rota"] . '">' . $item["rota"] . '</a></li>';
        }
        $links .= '</ul>';

        return $links;

    }

    public function rota()
    {

        $query = "select rota from rotas";

        $stmt = $this->conn->query($query);
        foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $rota){
            $rotas[] = $rota["rota"];
        }

        $url = $_SERVER['REQUEST_URI'];

        $link = explode("/", $url);

        if (in_array($link[1], $rotas)) {

            if (file_exists($link[1] . ".php")) {
                return $link[1] . ".php";
            } else {
                return "erro404.php";
            }

        } else {
            return "home.php";
        }
    }
}