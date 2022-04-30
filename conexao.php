<?php
require_once('config.ini.php');
  try{
      $conexao = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
    }catch (PDOException $e){
      print('Erro ao conectar com o banco de dados: '.$e->getMessage());
    }

?>
