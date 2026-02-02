<?php
session_start();

include_once '../configurable/connect_to_db.php';
include_once '../utility/validateCsrfToken.php';

$csrf = $_POST['csrf_token'];

if (!validateCsrfToken($csrf)) {
  $_SESSION['error'] = 'Возможна CSRF атака!';
  header('Location: ../index.php');
  exit;
}

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = 'Некорректный email';
  header('Location: ../index.php');
  exit;
}

$password = $_POST['password'];

try {

  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
  $stmt->execute([$email]);
  $result = $stmt->fetch();

  if (!isset($result) || $result['email'] !== $email || !password_verify($password, $result['password_hash'])) {

    $_SESSION['error'] = 'Неверный email или пароль';
    header('Location: ../index.php');
    exit;
  } else {

    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['email_verified'] = (int) $result['email_verified'];
    header('Location: ../chat.php');
    exit;
  }

} catch (PDOException $e) {
  echo $e->getMessage(); // Заменить на более общую ошибку в эксплуатации
}

print_r($result);

