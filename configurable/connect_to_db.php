<?php

$host = 'localhost';
$dbname = 'chat';
$username = 'root';
$password = '';

try {

  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::FETCH_DEFAULT, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo $e->getMessage(); // Заменить на более общую ошибку в эксплуатации
}
?>