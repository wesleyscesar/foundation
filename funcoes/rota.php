<?php

function rota(){

    $rotas = ['index','contato'];

    $url = $_SERVER['REQUEST_URI'];

    $link = explode("/",$url);

    if(in_array($link[1], $rotas)){
        if(file_exists($link[1].".php")){

            return $link[1].".php";
        } else {
            return "erro404.php";
        }

    }else{
        return "erro404.php";
    }

}