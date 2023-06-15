<?php
session_start();

require "conexaoMysql.php";
$pdo = mysqlConnect();

if (!isset($_SESSION['loggedIn'])) {
  header("location: ../pages/conta.html");
  exit();
}

$codigo = $_GET["codigo"] ?? "";

try {

  $sql = <<<SQL
  DELETE FROM anuncio
  WHERE codigo = ?
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$codigo]);

  header("location: mostrar_anuncios.php");
  exit();
} catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}
