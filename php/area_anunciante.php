<?php
session_start();
require "conexaoMysql.php";

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$email = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <!-- 1: Tag de responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/area_anunciante.css">
    <title>Área do Anunciante | H&I</title>

</head>

<body>
    <header>
        <nav class="nav-bar">
            <div class="logo">
                <a href="../index.html"><img src="../assets/images/logo.png" alt="logo"></a>
            </div>
            <div class="nav-list">
                <ul>
                    <li class="nav-item"><a href="../index.html" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="cria_anuncio.php" class="nav-link">Criar Anúncio</a></li>
                    <li class="nav-item"><a href="mostrar_anuncios.php" class="nav-link">Meus Anúncios</a></li>
                    <li class="nav-item"><a href="interesse.php" class="nav-link">Mensagens</a></li>
                    <li class="nav-item"><a href="altera_dados.php" class="nav-link">Meus Dados</a></li>
                    <!--<li class="nav-item"><a href="area_anunciante.php?sair=true" class="nav-link"> Sair</a></li>-->
                    <li class="nav-item"><a href="logout.php" class="nav-link"> Sair</a></li>
                </ul>
            </div>

            <div class="move">
                <button onclick="mostraMenu()" class="mobile-menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="mobile-menu-icon">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            </div>

        </nav>
        <div class="mobile-menu">
            <ul>
                <li class="nav-item"><a href="../index.html" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="cria_anuncio.php" class="nav-link">Criar Anúncio</a></li>
                <li class="nav-item"><a href="mostrar_anuncios.php" class="nav-link">Meus Anúncios</a></li>
                <li class="nav-item"><a href="interesse.php" class="nav-link">Mensagens</a></li>
                <li class="nav-item"><a href="altera_dados.php" class="nav-link">Meus Dados</a></li>
                <!--<li class="nav-item"><a href="area_anunciante.php?sair=true" class="nav-link"> Sair</a></li>-->
                <li class="nav-item"><a href="logout.php" class="nav-link"> Sair</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class=container2>
            <h2>Bem-vindo(a) à Área do Anunciante!</h2>
            <p>Escolha uma das opções abaixo para começar:</p>
            <div>
                <a href="cria_anuncio.php" class="opcoes">Criar Anúncio</a>
                <a href="mostrar_anuncios.php" class="opcoes">Meus Anúncios</a>
                <!--<a href="mensagens.php" class="opcoes">Mensagens</a>-->
                <a href="altera_dados.php" class="opcoes">Meus Dados</a>
                <a href="interesse.php" class="opcoes">Interesse</a>
            </div>
        </div>

    </main>

    <!---- Footer ------>
    <div class="rodape">
        <div class="grupo">
            <div class="linha">
                <div class="rodape-coluna-1">
                    <h3>Baixe nosso App</h3>
                    <p>Disponível tanto para Android quanto para iOS</p>
                    <div class="app-logo">
                        <img src="../assets/images/play-store.png" alt="play-store">
                        <img src="../assets/images/app-store.png" alt="app-store">
                    </div>
                </div>
                <div class="rodape-coluna-2">
                    <img src="../assets/images/logo-white.png" alt="logo-white">
                    <p>Nosso propósito é oferecer a melhor experência possível a um preço justo para nossos fiés
                        clientes </p>
                </div>
                <div class="rodape-coluna-3">
                    <h3>Links úteis</h3>
                    <ul>
                        <li>Cupons</li>
                        <li>Nosso blog</li>
                        <li>Política de devolução</li>
                        <li>Seja um afiliado</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">&copy; Copyright 2023 - H&I Inc.</p>
        </div>
    </div>

    <script src="../assets/js/menu-mobile.js"></script>
</body>

</html>