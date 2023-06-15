<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Endereco
{
  public $estado;
  public $bairro;
  public $cidade;

  function __construct($estado, $bairro, $cidade)
  {
    $this->estado = $estado;
    $this->bairro = $bairro; 
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? '';

try {

  $sql = <<<SQL
  SELECT * FROM base_enderecos
  WHERE cep = ?
  SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep]);
    $row = $stmt->fetch();

    $estado = $row["estado"];
    $bairro = $row["bairro"];
    $cidade = $row["cidade"];
    
    if ($estado == null)
    $endereco = new Endereco('', '', '');
    else
    $endereco = new Endereco($estado,$bairro,$cidade);
  
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
  }

  header('Content-type: application/json');  
  echo json_encode($endereco);
