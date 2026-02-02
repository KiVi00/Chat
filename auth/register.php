<?php
session_start();

include_once '../configurable/connect_to_db.php';
include_once '../utility/validateCsrfToken.php';

$csrf = $_POST['csrf_token'];

if (!validateCsrfToken($csrf)) {
  $_SESSION['error'] = 'Возможна CSRF атака!';
  header('Location: ../registration.php');
  exit;
}

$username = $_POST['username'];

if (!preg_match('/[a-zA-Z0-9]/', $username) || strlen($username) < 5 || strlen($username) > 15) {
  $_SESSION['error'] = 'Ваше имя недопустимо (15 > длина > 5, символы: a-zA-Z, 0-9)';
  header('Location: ../registration.php');
  exit;
}

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = 'Некорректный email';
  header('Location: ../registration.php');
  exit;
}

$password = $_POST['password'];

$password_hash = password_hash($password, PASSWORD_BCRYPT);

try {

  $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
  $stmt->execute([$email]);
  $count = $stmt->fetchColumn();

  if ($count > 0) {

    $_SESSION['error'] = 'Такой email уже зарегистрирован, попробуйте войти';
    header('Location: ../registration.php');
    exit;

  } else {

    $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $password_hash]);
    header('Location: ../index.php');
    exit;
  }
} catch (PDOException $e) {
  echo $e->getMessage(); // Заменить на более общую ошибку в эксплуатации
}
