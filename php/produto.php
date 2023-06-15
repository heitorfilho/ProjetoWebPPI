<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$productId = $_GET['id'] ?? '';

class Product
{
    public $id;
    public $name;
    public $price;
    public $date;
    public $category;
    public $description;
    public $imagePath;

    function __construct($id, $name, $price, $date, $category, $description, $imagePath)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->date = $date;
        $this->category = $category;
        $this->description = $description;
        $this->imagePath = $imagePath;
    }
}


$sql = <<<SQL
    SELECT anuncio.codigo, anuncio.titulo, anuncio.preco, anuncio.dataHora, anuncio.codCategoria, anuncio.descricao, foto.nomeArqFoto
    FROM anuncio
    INNER JOIN foto ON anuncio.codigo = foto.codAnuncio
    WHERE anuncio.codigo = :id
SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch();
    if (!$row) {
        exit('Produto não encontrado');
    }

    $product = new Product($row['codigo'], $row['titulo'], $row['preco'], $row['dataHora'], $row['codCategoria'], $row['descricao'], $row['nomeArqFoto']);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes | H&I</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        .form-group {
            margin-bottom: 10px;
            margin-top: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        textarea,
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<style>

</style>

<body>
    <!---------- Header ----------------->
    <div class="navbar">
        <div class="logo">
            <a href="../index.html" aria-label="Logo"><img src="../assets/images/logo.png" width="200px" alt="logo"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                <li><a href="../index.html">Início</a></li>
                <li><a href="../pages/produtos.html">Produtos</a></li>
                <li><a href="area_anunciante.php">Conta</a></li>
            </ul>
        </nav>
    </div>
    <div class="grupo">
    </div>
    <!-------- Detalhes de único produto -------->

    <div class="small-grupo unico-produto">
        <div class="linha">
            <div class="coluna-2">
                <div class="small-img-linha">
                    <div class="small-img-coluna">
                        <img class="product-image" src="../assets/images/<?php echo $product->imagePath; ?>" alt="Product Image">
                    </div>
                </div>
            </div>
            <div class="coluna-2">
                <h1><?php echo $product->name; ?></h1>
                <h4>R$<?php echo $product->price; ?>,00</h4>
                <h3>Descrição <i class="fa fa-indent"></i></h3>
                <br>
                <p><?php echo $product->description; ?></p>
                <form id="formularioInteresse" action="usuarioInteresse.php" method="post">
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contato:</label>
                        <input type="text" id="contato" name="contato" required>
                    </div>
                    <div class="form-group" style="display: none;">
                        <input type="number" id="codAnuncio" name="codAnuncio">
                    </div>
                    <div class="form-group">
                        <button id="btnForm" type="submit">Enviar</button>
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>

    <!---- Rodape ------>
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

    <script>
        const codAnuncio = document.querySelector("#codAnuncio");
        const formularioInteresse = document.getElementById('formularioInteresse');
        const mensagemInput = document.getElementById('mensagem');
        const contatoInput = document.getElementById('contato');

        codAnuncio.value = "<?php echo $product->id; ?>";

        formularioInteresse.addEventListener('submit', async function(event) {
            event.preventDefault(); // Impedir o comportamento padrão de envio

            // Obter os dados do formulário
            const formData = new FormData(this);

            try {
                // Enviar os dados do formulário via Fetch API
                const response = await fetch('usuarioInteresse.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    alert('Mensagem enviada com sucesso!');
                    // Limpar os campos do formulário
                    mensagemInput.value = '';
                    contatoInput.value = '';
                } else {
                    alert('Falha ao enviar a mensagem. Por favor, tente novamente.');
                }
            } catch (error) {
                console.error('Ocorreu um erro:', error);
                alert('Ocorreu um erro ao processar a solicitação. Por favor, tente novamente mais tarde.');
            }
        });
    </script>
</body>

</html>