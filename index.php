<?php
session_start();
include_once 'utility/generateCsrfToken.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/main.css">
  <title>Вход в чат</title>
</head>

<body>
  <?php if (isset($_SESSION['error'])): ?>
    <p>
      <?= $_SESSION['error'] ?? '' ?>
      <?php unset($_SESSION['error']); ?>
    </p>
  <?php endif ?>

  <div class="variants">
    <a href="chat.php">Чат</a>
    <a href="registration.php">Зарегистрироваться</a>
  </div>
  <form action="auth/auth.php" method="post">
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <label for="password" id="password" name="password">Пароль</label>
    <input type="password" id="password" name="password">
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <button>Войти</button>
  </form>
</body>

</html>