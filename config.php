
<?php

require_once "header.php";

define('CLASS_DIR', 'src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register(function ($class){
    require_once(str_replace('\\','/',$class . '.php'));
});

$conexao = new Wesley\Config\Conexao();
$usuario = new Wesley\Usuario\Usuario($conexao);

$tbLogin = isset($_POST['tbLogin'])?$_POST['tbLogin']:'';
$tbSenha = isset($_POST['tbSenha'])?$_POST['tbSenha']:'';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($usuario->autenticar($tbLogin,$tbSenha) > 0) {
        $_SESSION['autenticacao'] = 1;
        echo "logado";
    } else {
        echo "Usuario ou Senha Invalidos";
    }
}


?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Chamadas JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

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
</body>
</html>
