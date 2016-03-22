<?php require_once('./funcoes/rota.php'); ?>

<html>
<head>
    <title>Primeira Pagina </title>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Chamadas JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<nav role="navigation" class="navbar navbar-default">

    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Navegação Responsiva</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">Menu</a>
    </div>

    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="index">Home</a></li>
            <li><a href="#">Empresa</a></li>
            <li><a href="#">Produtos</a></li>
            <li><a href="#">Serviços</a></li>
            <li><a href="contato">Contato</a></li>
        </ul>
    </div>

</nav>
