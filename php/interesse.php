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
    SELECT anuncio.codigo, anuncio.titulo, categoria.nome, anuncio.preco, anuncio.dataHora, anuncio.descricao, foto.nomeArqFoto,
    interesse.codigo AS codInteresse, interesse.mensagem, interesse.dataHora AS dataHoraInteresse, interesse.contato
    FROM anuncio
    INNER JOIN anunciante ON anunciante.email = :email
    INNER JOIN foto ON foto.codAnuncio = anuncio.codigo
    INNER JOIN categoria ON categoria.codigo = anuncio.codCategoria
    LEFT JOIN interesse ON interesse.codAnuncio = anuncio.codigo
    WHERE anuncio.codAnunciante = anunciante.codigo AND interesse.codigo IS NOT NULL
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mensagens de interesse | H&I</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/mostrar_anuncios.css">
    <style>

    </style>
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
        <div class="container">
            <h3>Mensagens de interesse</h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th></th>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Data da Publicação</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Foto</th>
                    <th>Mensagem</th>
                    <th>Data/Hora</th>
                    <th>Contato</th>
                </tr>

                <?php
                while ($row = $stmt->fetch()) {

                    $codigo = $row['codigo'];
                    $titulo = htmlspecialchars($row['titulo']);
                    $categoria = htmlspecialchars($row['nome']);
                    $dataHora = htmlspecialchars($row['dataHora']);
                    $preco = htmlspecialchars($row['preco']);
                    $descricao = htmlspecialchars($row['descricao']);
                    $nomeArqFoto = htmlspecialchars($row['nomeArqFoto']);
                    $codInteresse = htmlspecialchars($row['codInteresse']);
                    $mensagem = htmlspecialchars($row['mensagem']);
                    $dataHoraInteresse = htmlspecialchars($row['dataHoraInteresse']);
                    $contato = htmlspecialchars($row['contato']);

                    echo <<<HTML
                    <tr>
                        <td>
                            <a href="exclui_mensagem.php?id=$codInteresse">
                                <img src="../assets/images/delete.png" width="20" height="20">
                            </a>
                        </td> 
                        <td>$titulo</td>
                        <td>$categoria</td>
                        <td>$dataHora</td> 
                        <td>$preco</td>
                        <td>$descricao</td>
                        <td>$nomeArqFoto</td>
                        <td>$mensagem</td>
                        <td>$dataHoraInteresse</td>
                        <td>$contato</td>
                    </tr>      
                HTML;
                }
                ?>

            </table>
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
