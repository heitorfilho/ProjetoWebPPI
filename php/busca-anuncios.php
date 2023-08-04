<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Anuncio
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
    SELECT codigo, titulo, preco, descricao, nomeArqFoto 
    FROM anuncio, foto 
    WHERE codigo = codAnuncio
    SQL;

  $rows = $pdo->query($sql);

  $anuncios = array();
  foreach ($rows as $row) {
    $codigo = $row["codigo"];
    $titulo = $row["titulo"];
    $preco = $row["preco"];
    $descricao = $row["descricao"];
    $anuncio = new Anuncio($codigo, $titulo, $preco, $descricao);
    array_push($anuncios, $anuncio);
  }
} catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}

header('Content-type: application/json');
echo json_encode($anuncios);
