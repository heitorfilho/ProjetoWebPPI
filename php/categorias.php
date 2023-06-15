<?php
// sera usado para carregar todas as categorias e retornar um json em array com todas as categorias

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Category
{
  public $name;
  public $code;

  function __construct($name, $code)
  {
    $this->name = $name;
    $this->code = $code;
  }
}

$sql = <<<SQL
    SELECT nome, codigo
    FROM categoria
    SQL;

try {
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $categories = array();
  while ($row = $stmt->fetch()) {
    $categories[] = new Category($row['nome'], $row['codigo']);
  }
  echo json_encode($categories);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
