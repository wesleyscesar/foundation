<?php

session_start();

require_once "header.php";

set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
$usuario = new Wesley\Usuario\Usuario($conexao);

$tbLogin = isset($_POST['tbLogin'])?$_POST['tbLogin']:'';
$tbSenha = isset($_POST['tbSenha'])?$_POST['tbSenha']:'';

$_SESSION['autenticacao'] = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($usuario->autenticar($tbLogin,$tbSenha) > 0) {
        $_SESSION['autenticacao'] = 1;
        header("location: administracao.php");
    } else {
        echo "Usuario ou Senha Invalidos";
    }
}


?>

<form action="" method="post" class="box login">
    <fieldset class="boxBody">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="tbLogin" name="tbLogin" placeholder="Login">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="text" class="form-control" id="tbSenha" name="tbSenha" placeholder="Senha">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Entrar</button>
    </fieldset>
    <footer>
        <label><font color="red"><?php echo $msg; ?></font></label>
    </footer>
</form>
