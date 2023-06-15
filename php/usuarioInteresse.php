<?php
session_start();

require "conexaoMysql.php";
$pdo = mysqlConnect();

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$email = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = $_POST["mensagem"];
    $contato = $_POST["contato"];
    $codAnuncio = $_POST["codAnuncio"];

    // Data e hora atuais
    $dataHora = date("Y-m-d H:i:s");

    try {
        // Preparar a declaração SQL
        $sql = <<<SQL
        INSERT INTO interesse (mensagem, dataHora, contato, codAnuncio)
        VALUES (?, ?, ?, ?)
        SQL;

        $stmt = $pdo->prepare($sql);

        // Executar a declaração SQL com os valores fornecidos
        $stmt->execute([$mensagem, $dataHora, $contato, $codAnuncio]);

        // Verificar se a inserção foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            // Inserção bem-sucedida
            header("HTTP/1.1 200 OK");
            exit();
        } else {
            // Inserção falhou
            header("HTTP/1.1 500 Internal Server Error");
            exit();
        }
    } catch (Exception $e) {
        // Erro ao executar a declaração SQL
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}
