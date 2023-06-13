<?php
namespace Ssrc;
 class DataBaseConnect{
  private $host = "mysql-8";
  private $user = "root";
  private $pass = "test";
  private $db = "test";
  private $charset = 'utf8';
  public $connect;

  function __construct()
  {
    $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
    $opt = [
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
      $this->connect = new \PDO($dsn, $this->user, $this->pass, $opt);
    } catch (\PDOException $e) {
      die('Подключение не удалось: ' . $e->getMessage());
    }

  }
  public function bd()
  {
    return $this->connect;
  }

  
 }
?>