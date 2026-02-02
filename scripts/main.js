'use strict';
if (document.getElementById('chat-form')) {
  document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('message_processing/send_message.php', {
      method: 'POST',
      body: formData,
      credentials: 'same-origin'

    })
      .then(response => {
        if (!response.ok) throw new Error('Сетевая ошибка');
        return response.text();
      })
      .then(() => {
        this.reset();
        loadMessages();
      })
      .catch(error => console.error('Ошибка:', error));
  });
}

function loadMessages() {
  fetch('message_processing/get_messages.php', { credentials: 'include' })
    .then(response => response.text())
    .then(data => {
      document.getElementById('chat-container').innerHTML = data;

      const container = document.getElementById('chat-container');
      container.scrollTop = container.scrollHeight;
    });
}

setInterval(loadMessages, 2000);

loadMessages();