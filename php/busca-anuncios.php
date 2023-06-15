<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class anuncio
{
  public $codigo;
  public $titulo;
  public $preco;
  public $descricao;

  function __construct($codigo, $titulo, $preco, $descricao)
  {
    $this->codigo = $codigo;
    $this->titulo = $titulo; 
    $this->preco = $preco;
    $this->descricao = $descricao;
  }
}

try {

  $sql = <<<SQL
  SELECT codigo, titulo, preco, descricao, nomeArqFoto FROM anuncio,foto WHERE codigo = codAnuncio
  SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetch();

    $anuncios = array();
    foreach ($rows as $row) {
        $codigo = $row["codigo"];
        $titulo = $row["titulo"];
        $preco = $row["preco"];
        $descricao = $row["descricao"];
        $anuncio = new anuncio($codigo,$titulo,$preco,$descricao);
        array_push($anuncios, $anuncio);
    }
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
  }

  header('Content-type: application/json');  
  echo json_encode($anuncios);
