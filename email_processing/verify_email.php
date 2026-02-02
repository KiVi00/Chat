<?php

session_start();

include_once '../utility/checkAuth.php';
include_once '../configurable/connect_to_db.php';

$user_code = $_POST['verification_code'];

if ($user_code == $_SESSION['verification_code']) {
  try {

    $stmt = $pdo->prepare('UPDATE users SET email_verified = ? WHERE user_id = ?');
    $stmt->execute([1, $_SESSION['user_id']]);

    $_SESSION['email_verified'] = 1;
    $_SESSION['notification'] = 'Email успешно подтвержден!';
    header('Location: ../chat.php');
    exit;

  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}