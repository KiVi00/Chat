<?php

session_start();
include_once 'utility/checkAuth.php';


?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Чат</title>
</head>

<body>
  <p>Здравствуйте, <?= $_SESSION['username'] ?></p>
  <a href="logout.php">Выйти из аккаунта</a>
  <?php if ($_SESSION['email_verified'] === 0): ?>
    <p>Подтвердите email для получения возможности писать в чате</p>
    <a href="email_processing/send_email.php">Подтвердить email</a>
    <?php if (isset($_SESSION['verification_code'])): ?>
      <?= $_SESSION['notification'] ?? '' ?>
      <?php unset($_SESSION['notification']); ?>
      <form action="email_processing/verify_email.php" method="post">
        <label for="verification_code">Введите код из письма</label>
        <input type="text" name="verification_code" id="verification_code">
        <button>Подтвердить email</button>
      </form>
    <?php endif ?>
  <?php endif ?>
  <?php if ($_SESSION['email_verified'] == 1): ?>
    <form id="chat-form" action="message_processing/send_message.php" method="post">
      <textarea name="message" placeholder="Сообщение" required></textarea>
      <button type="submit">Отправить</button>
    </form>
  <?php endif ?>
  <div id="chat-container">
  </div>
  <script src="scripts/main.js"></script>
</body>

</html>