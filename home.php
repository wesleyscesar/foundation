<?php

set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
$rotas = new Wesley\Rota\Rota($conexao);

$pesquisa = isset($_POST['pesquisa'])?$_POST['pesquisa']:'';

$links = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $links = $rotas->conteudo($link[1]);
}

?>

<h1> Pagina Inicial </h1>
<form class="form-inline" method="post">
    <div class="form-group">
        <label for="pesquisa">Pesquisar</label>
        <input type="text" name="pesquisa" class="form-control" id="pesquisa" placeholder="Pesquisa">
    </div>
    <button type="submit" class="btn btn-primary">Pesquisar</button>
</form>

<?php echo $links; ?>
