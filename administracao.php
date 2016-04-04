<?php
session_start();

require_once "header.php";

if($_SESSION['autenticacao'] > 0) {
    define('CLASS_DIR', 'src/');
    set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
    spl_autoload_register(function ($class){
        require_once(str_replace('\\','/',$class . '.php'));
    });

    $conexao = new Wesley\Config\Conexao();
    $rotas = new Wesley\Rota\Rota($conexao);

    $id = isset($_GET['id'])?$_GET['id']:0;

    if($id > 0){
        $result = $rotas->getConteudo($id);
    }

    $tbArea = isset($_POST['tbArea'])?$_POST['tbArea']:'';
    $tbId = isset($_POST['tbId'])?$_POST['tbId']:'';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $rotas->setCont($tbArea);
        $rotas->setConteudo($tbId);
        $result = $rotas->getConteudo($tbId);
    }
} else {
    header("location: autenticacao.php");
}
?>

<ul style="margin-left:10px;" class="list-inline">
    <?php $rotas->getPaginas(); ?>
</ul>

<form action="" method="post" class="box login">
    <input type="hidden" name="tbId" value="<?php echo $id; ?>">
    <textarea name="tbArea"><?php echo $result['conteudo']; ?></textarea>
    <br>
    <button type="submit" class="btn btn-primary" style="margin-left: 10px;"> Salvar </button>
</form>