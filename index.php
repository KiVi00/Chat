<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Чат</title>
</head>

<body>
  <form>
    <label for="chat">Чат</label>
    <input type="text" name="message">
    <button>Отправить</button>
  </form>
  <p id="result"></p>
</body>

<script>
  document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('process.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(data => console.log(data));
  });

</script>

</html>