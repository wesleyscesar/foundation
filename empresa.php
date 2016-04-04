<?php

define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
$rotas = new Wesley\Rota\Rota($conexao);

$url = $_SERVER['REQUEST_URI'];

$link = explode("/",$url);

$result = $rotas->getPagina($link[1]);

echo $result['conteudo'];

?>
