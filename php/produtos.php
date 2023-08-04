<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$codigoCategoria = $_GET['codCategoria'] ?? '';
$nome = $_GET['nome'] ?? '';

$page = $_GET['page'] ?? 1; // Página atual
$itemsPerPage = 6; // Número de itens por página
$offset = ($page - 1) * $itemsPerPage; // Cálculo do offset

class Product
{
    public $code;
    public $name;
    public $price;
    public $date;
    public $category;
    public $description;
    public $imagePath;

    function __construct($code, $name, $price, $date, $category, $description, $imagePath)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->date = $date;
        $this->category = $category;
        $this->description = $description;
        $this->imagePath = $imagePath;
    }
}

$sql = <<<SQL
    SELECT anuncio.codigo, anuncio.titulo, anuncio.preco, anuncio.dataHora, anuncio.codCategoria, anuncio.descricao, foto.nomeArqFoto
    FROM anuncio
    INNER JOIN (
        SELECT anuncio.codigo
        FROM anuncio
SQL;

$params = array();

if (!empty($codigoCategoria)) {
    $sql .= " WHERE anuncio.codCategoria = ?";
    $params[] = $codigoCategoria;
}

if (!empty($nome)) {
    if (!empty($codigoCategoria)) {
        $sql .= " AND";
    } else {
        $sql .= " WHERE";
    }
    $sql .= " anuncio.titulo LIKE ?";
    $params[] = "%$nome%";
}

$sql .= " ORDER BY anuncio.dataHora DESC";
$sql .= " LIMIT ?, ?";
$params[] = $offset;
$params[] = $itemsPerPage;

$sql .= ") AS anuncios_paginados ON anuncio.codigo = anuncios_paginados.codigo";
$sql .= " INNER JOIN foto ON anuncio.codigo = foto.codAnuncio";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = array();
    while ($row = $stmt->fetch()) {
        $products[] = new Product($row['codigo'], $row['titulo'], $row['preco'], $row['dataHora'], $row['codCategoria'], $row['descricao'], $row['nomeArqFoto']);
    }
    echo json_encode($products);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
