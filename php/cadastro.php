<?php

require "conexaoMysql.php";
$conn = mysqlConnect();

try {
  $nome = $_POST["nome"] ?? "";
  $cpf = $_POST["cpf"] ?? "";
  $email = $_POST["email"] ?? "";
  $senha = $_POST["senha"] ?? "";
  $telefone = $_POST["telefone"] ?? "";

  $hashsenha = password_hash($senha, PASSWORD_DEFAULT);

  $sql = <<<SQL
  INSERT INTO anunciante (nome, cpf, email, hash_senha, telefone)
  VALUES (?, ?, ?, ?, ?)
  SQL;

  // Iniciando uma transação
  $conn->beginTransaction();
  // Prepared statement (evita SQL injection)
  $stmt = $conn->prepare($sql);
  if (!$stmt->execute([$nome, $cpf, $email, $hashsenha, $telefone])) {
    throw new PDOException('Erro ao cadastrar anunciante');
  }
  $id_anunciante = $conn->lastInsertId();

  // Confirmar a transação
  $conn->commit();

  header("location: ../pages/sucessoCadastro.html");
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
