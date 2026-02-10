<?php

session_start();
include_once 'utility/checkAuth.php';


?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/chat.css">
  <title>Чат</title>
</head>

<body>

  <div class="window">
    <div class="variants">
      <p class="hello">Здравствуйте, <?= $_SESSION['username'] ?>!</p>
      <a href="logout.php">Выйти из аккаунта</a>
    </div>
    <div class="variants">
      <?php if ($_SESSION['email_verified'] === 0): ?>
        <p>Подтвердите email для получения доступа</p>
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
    </div>
    <div id="chat-container">
    </div>
    <?php if ($_SESSION['email_verified'] == 1): ?>
      <form id="chat-form" action="message_processing/send_message.php" method="post">
        <textarea name="message" placeholder="Сообщение" required></textarea>
        <button type="submit" aria-label="Отправить">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
              <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
      </form>
    <?php endif ?>
    <script src="scripts/main.js"></script>
  </div>

</body>

</html>