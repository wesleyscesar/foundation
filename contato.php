<?php

$tbNome     = isset($_POST['tbNome'])?$_POST['tbNome']:'';
$tbEmail    = isset($_POST['tbEmail'])?$_POST['tbEmail']:'';
$tbAssunto  = isset($_POST['tbAssunto'])?$_POST['tbAssunto']:'';
$tbMensagem = isset($_POST['tbMensagem'])?$_POST['tbMensagem']:'';

$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem .= "Dados enviados com sucesso, abaixo seguem os dados que voce enviou";
    $mensagem .= "<br>Nome: {$tbNome}";
    $mensagem .= "<br>Email: {$tbEmail}";
    $mensagem .= "<br>Assunto: {$tbAssunto}";
    $mensagem .= "<br>Mensagem: {$tbMensagem}";
}

?>

<form action="" method="post">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="tbNome" name="tbNome" placeholder="Nome">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="tbEmail" name="tbEmail" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="assunto">Assunto</label>
        <input type="text" class="form-control" id="tbAssunto" name="tbAssunto" placeholder="Assunto">
    </div>
    <div class="form-group">
        <label for="mensagem">Mensagem</label>
        <textarea class="form-control" rows="3" id="tbMensagem" name="tbMensagem" placeholder="Mensagem"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>

<p class="text-success"><?php echo $mensagem; ?></p>

<?php require_once('footer.php'); ?>