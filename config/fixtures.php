<?php

require_once "conexao.php";

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
}