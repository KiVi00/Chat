<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Чат</title>
</head>

<body>
  <form id="chat-form">
    <input type="text" name="username" placeholder="Ваше имя" required>
    <textarea name="message" placeholder="Сообщение" required></textarea>
    <button type="submit">Отправить</button>
  </form>
  <div id="chat-container">

  </div>
  <script src="scripts/main.js"></script>
</body>

</html>