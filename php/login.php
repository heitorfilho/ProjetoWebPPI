<?php
require "conexaoMysql.php";

$email = $_POST["email"] ?? '';
$senha = $_POST["senha"] ?? '';

try {
  $conn = mysqlConnect();
  $stmt = $conn->prepare("SELECT hash_senha FROM anunciante WHERE email = ?");
  $stmt->execute([$email]);
  $senhaHash = $stmt->fetchColumn();

  if (!$senhaHash || !password_verify($senha, $senhaHash)) {
    $response = ['success' => false, 'detail' => '../pages/conta.html#formEntrar'];
  } else {
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $email;
    setcookie('myCookie', 'cookieValue', time() + 28800); // Cookie expira em 8 horas
    $response = ['success' => true, 'detail' => '../php/area_anunciante.php'];
  }

  echo json_encode($response);
  exit();
} catch (PDOException $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}
