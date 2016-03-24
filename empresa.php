<?php

    $conteudo = isset($_GET['conteudo'])?$_GET['conteudo']:'';
    $titulo   = isset($_GET['titulo'])?$_GET['titulo']:'';

?>

<h1><?php echo $titulo; ?></h1>
<br>
<h3><?php echo $conteudo; ?></h3>
