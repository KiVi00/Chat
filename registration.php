<?php
session_start();
include_once 'utility/generateCsrfToken.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/main.css">
  <title>Регистрация в чат</title>
</head>

<body>
  <p>
    <?= $_SESSION['error'] ?? '' ?>
    <?php unset($_SESSION['error']); ?>
  </p>
  <div class="variants">
      <a href="chat.php">Чат</a>
    <a href="index.php">Войти</a>
  </div>
  <form action="auth/register.php" method="post">
    <label for="username">Имя в чате</label>
    <input type="text" id="username" pattern="[a-zA-Z, 0-9]{5,15}" name="username">
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <label for="password">Пароль</label>
    <input type="password" id="password" name="password">
    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
    <button>Зарегистрироваться</button>
  </form>
</body>

</html>