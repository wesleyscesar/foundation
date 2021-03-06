<?php

require_once ('header.php');

define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
//$fixtures = new Wesley\Config\Fixtures($conexao);
$rotas = new Wesley\Rota\Rota($conexao);

require_once ($rotas->rota());

require_once ('footer.php');

?>
