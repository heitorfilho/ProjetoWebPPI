<?php
session_start();

$email = $_SESSION['user'];

require "conexaoMysql.php";
$pdo = mysqlConnect();

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

try {

    $sql = <<<SQL
  SELECT nome,cpf,hash_senha,telefone
  FROM anunciante
  WHERE anunciante.email = '$email'
  SQL;

    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <!-- 1: Tag de responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus Dados | H&I</title>

    <!-- 2: Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/altera_dados.css">

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
                <li class="nav-item"><a href="mensagens.php" class="nav-link">Mensagens</a></li>
                <li class="nav-item"><a href="altera_dados.php" class="nav-link">Meus Dados</a></li>
                <!--<li class="nav-item"><a href="area_anunciante.php?sair=true" class="nav-link"> Sair</a></li>-->
                <li class="nav-item"><a href="logout.php" class="nav-link"> Sair</a></li>
            </ul>
        </div>
    </header>


    <div class="container">
        <h3>Alterar Dados</h3>
        <hr>
        <form action="formAltera.php" method="post">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" required>
                </div>

                <div class="col-sm-6">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" required>
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Telefone</label>
                    <input type="tel" name="telefone" class="form-control" id="telefone" required>
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-secondary">Enviar</button>
                </div>
            </div>
        </form>
        <hr>
        <h3>Meus Dados</h3>
        <hr>

        <?php
        while ($row = $stmt->fetch()) {

            $nome = $row['nome'];
            $cpf = htmlspecialchars($row['cpf']);
            $telefone = htmlspecialchars($row['telefone']);
            $senha = htmlspecialchars($row['hash_senha']);
            $email = $_SESSION['user'];

            echo <<<HTML
    <strong>Nome: </strong><p>$nome</p>
    <strong>CPF: </strong><p>$cpf</p>
    <strong>Telefone: </strong><p>$telefone</p> 
    <strong>Email: </strong><p>$email</p>
    <strong>Senha: </strong>
    <div class="password-wrapper">
      <input type="password" value="$senha" readonly>
      <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">Mostrar</button>
    </div>
  HTML;
        }
        ?>
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
    <script src="../assets/js/altera_dados.js"></script>

</body>

</html>