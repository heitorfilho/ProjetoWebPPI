<?php
session_start();

require "conexaoMysql.php";
$pdo = mysqlConnect();

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$id = $_GET["id"] ?? "";

try {
    $sql = <<<SQL
    DELETE FROM interesse
    WHERE codigo = :id
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("location: interesse.php");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>