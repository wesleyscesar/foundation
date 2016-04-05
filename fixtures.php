<?php

set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
$fixtures = new Wesley\Config\Fixtures($conexao);

header("location: index.php");
?>