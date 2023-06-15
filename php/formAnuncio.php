<?php

session_start();

require "conexaoMysql.php";
$conn = mysqlConnect();

//$foto = $_FILES["foto"];

//verifica se a foto foi enviada
if (isset($_POST['titulo'])) {
  // Resgata os dados do anunciante
  $titulo = $_POST["titulo"] ?? "";
  $categoria = $_POST["categoria"] ?? "";
  $descricao = $_POST["descricao"] ?? "";
  $preco = $_POST["preco"] ?? "";
  $dataHora = $_POST["data"] ?? "";
  $cep = $_POST["cep"] ?? "";
  $estado = $_POST["estado"] ?? "";
  $bairro = $_POST["bairro"] ?? "";
  $cidade = $_POST["cidade"] ?? "";
  $email = $_SESSION['user'];
  $fotos = array();

  if (isset($_FILES['foto'])) {
    for ($i = 0; $i < count($_FILES['foto']['name']); $i++) {

      $nomeArqFoto = $_FILES['foto']['name'][$i];
      move_uploaded_file($_FILES['foto']['tmp_name'][$i], '../assets/images/' . $nomeArqFoto);

      //salvando nomes para enviar para o banco
      array_push($fotos, $nomeArqFoto);
    }
  }
} else {
  echo "Você não realizou o upload de forma satisfatória.";
}


$sql1 = <<<SQL
  INSERT INTO anuncio (titulo, descricao, preco, dataHora, 
                       cep, estado, bairro, cidade,codCategoria,codAnunciante)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO foto 
    (codAnuncio,nomeArqFoto)
  VALUES (?,?)
  SQL;

$sql3 = <<<SQL
  SELECT codigo
  FROM anunciante WHERE email = '$email'
  SQL;


try {
  $conn->beginTransaction();

  $sql3 = $conn->query($sql3);
  $row = $sql3->fetch();
  $codAnunciante = $row['codigo'];

  $stmt1 = $conn->prepare($sql1);
  if (!$stmt1->execute([
    $titulo, $descricao, $preco, $dataHora,
    $cep, $estado, $bairro, $cidade, $categoria, $codAnunciante
  ])) throw new Exception('Falha na primeira inserção');

  $codAnuncio = $conn->lastInsertId();
  $stmt2 = $conn->prepare($sql2);
  if (!$stmt2->execute([
    $codAnuncio, $nomeArqFoto
  ])) throw new Exception('Falha na segunda inserção');

  // Efetiva as operações
  $conn->commit();

  header("location: area_anunciante.php");
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
