<?php
session_start();

require "conexaoMysql.php";
$pdo = mysqlConnect();


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
    <title>Criar Anúncio | H&I</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/cria_anuncio.css">
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
                    <li class="nav-item"><a href="area_anunciante.php" class="nav-link">Área do Anunciante</a></li>
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
                <li class="nav-item"><a href="area_anunciante.php" class="nav-link">Área do Anunciante</a></li>
                <li class="nav-item"><a href="cria_anuncio.php" class="nav-link">Criar Anúncio</a></li>
                <li class="nav-item"><a href="mostrar_anuncios.php" class="nav-link">Meus Anúncios</a></li>
                <!--<li class="nav-item"><a href="mensagens.php" class="nav-link">Mensagens</a></li>-->
                <li class="nav-item"><a href="altera_dados.php" class="nav-link">Meus Dados</a></li>
                <!--<li class="nav-item"><a href="area_anunciante.php?sair=true" class="nav-link"> Sair</a></li>-->
                <li class="nav-item"><a href="logout.php" class="nav-link"> Sair</a></li>
            </ul>
        </div>
    </header>

    <div class="container">

        <main>
            <form action="formAnuncio.php" method="POST" enctype="multipart/form-data">

                <fieldset>
                    <legend>Dados do Anúncio</legend>

                    <div class="row g-3">
                        <!-- titulo e descricao -->
                        <div class="col-sm-4">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" required>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Categoria</label>
                            <select name="categoria" class="form-select" id="categoria" required>
                                <option value="" selected>Selecione</option>

                                <?php
                                $select = $pdo->prepare("SELECT nome, codigo FROM categoria ORDER BY nome ASC");
                                $select->execute();
                                $fetchAll = $select->fetchAll();
                                foreach ($fetchAll as $categorias) {
                                    echo '<option value="' . $categorias['codigo'] . '">' . $categorias['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="preco" class="form-label">Preço</label>
                            <input type="number" name="preco" class="form-control" id="preco" min="0" placeholder="R$" required>
                        </div>

                        <div class="col-sm-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="datetime-local" name="data" class="form-control" id="data" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="foto" class="form-label">Foto do Produto</label>
                            <input type="file" accept=".png, .jpg, .jpeg" name="foto[]" multiple class="form-control" id="foto" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea name="descricao" rows="" cols="" class="form-control" required></textarea>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Dados de Endereço</legend>

                        <div class="row g-3">
                            <!-- CEP e endereço -->
                            <div class="col-sm-6">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" class="form-control" id="cep" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="estado" class="form-label">Estado</label>
                                <!-- <input type="text" name="estado" class="form-control" id="estado" required> -->
                                <select name="estado" class="form-control" id="estado" required></select>
                            </div>

                            <!-- Bairro e cidade -->
                            <div class="col-sm-6">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" name="bairro" class="form-control" id="bairro" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <!-- <input type="text" name="cidade" class="form-control" id="cidade" required> -->
                                <select name="cidade" class="form-control" id="cidade" required></select>
                            </div>
                        </div>
                    </fieldset>


                    <div class="col-12">
                        <button type="submit" class="btn btn-secondary">Publicar</button>
                    </div>
            </form>
        </main>
    </div>
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
    <script src="../assets/js/cria_anuncio.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>