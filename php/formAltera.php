<?php

session_start();

$email = $_SESSION['user'];

require "conexaoMysql.php";
$conn = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$senha = $_POST["senha"] ?? "";
$telefone = $_POST["telefone"] ?? "";

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

try {

  $sql = <<<SQL
  -- Repare que a coluna Id foi omitida por ser auto_increment
  UPDATE anunciante 
  SET nome = ?,
  cpf = ?,
  telefone = ?,
  hash_senha = ?
  WHERE email = '$email'
  SQL;

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    $nome, $cpf, $telefone, $hashsenha
  ]);

  header("location: altera_dados.php");
  exit();
} catch (Exception $e) {
  // Caso ocorra algum erro, desfazer a transação
  $conn->rollBack();
  $errorCode = $e->getCode();
  $errorMessage = $e->getMessage();
  if ($errorCode === 1062) {
    exit('Dados duplicados: ' . $errorMessage);
  } else {
    exit('Falha ao cadastrar os dados: ' . $errorMessage);
  }
} finally {
  // Fechando a conexão com o banco de dados
  if ($conn !== null) {
    $conn = null;
  }
}
