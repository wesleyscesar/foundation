<?php

require_once "./config/conexao.php";

function conteudo($str){

    $sql = "SELECT * FROM rotas WHERE conteudo LIKE '%" . $str . "%'";
    $conn = getConexao();
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $links = '<ul>';
    foreach ($stmt->fetchAll() as $item) {
        $links .= '<li><a href="' . $item["rota"] . '?conteudo=' . $item["conteudo"] . '&titulo=' . $item["titulo"] . ' ">' . $item["titulo"] . '</a></li>';
    }
    $links .= '</ul>';

    return $links;

}

function rota(){

    $rotas = ['home','contato','empresa'];

    $url = $_SERVER['REQUEST_URI'];

    $link = explode("/",$url);

    $link = strstr($link[1], '?', true);

    if(in_array($link, $rotas)){
        if(file_exists($link.".php")){

            return $link.".php";
        } else {
            return "erro404.php";
        }

    }else{
        return "home.php";
    }

}
