<?php
require_once 'config.php';

/**
 * Crie um arquivo config.php seguindo o formato abaixo e substitua os valores 
 * das constantes pelos valores do seu banco de dados:
 * 
 * <?php
 * define('DB_HOST', 'nome_do_host');
 * define('DB_NAME', 'nome_do_banco_de_dados');
 * define('DB_USERNAME', 'nome_do_usuario');
 * define('DB_PASSWORD', 'senha_do_usuario');
 * 
 */
function mysqlConnect()
{
  // dsn é apenas um acrônimo de database source name
  $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa o modo de erros para lançar exceções    
    PDO::ATTR_PERSISTENT    => true, // ativa o uso de conexões persistentes para maior eficiência
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // altera o modo padrão do método fetch para FETCH_ASSOC
  ];

  try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
    return $pdo;
  } catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
  }
}
