<?php
    require_once ('header.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $tbPesquisar = isset($_POST['pesquisa'])?$_POST['pesquisa']:'';

        $links = conteudo($tbPesquisar);
    }

    require_once (rota());


    require_once ('footer.php');


?>
