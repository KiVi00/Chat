'use strict';
document.getElementById('chat-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('send_message.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(() => {
      this.reset();
      loadMessages();
    });
});

function loadMessages() {
  fetch('get_messages.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('chat-container').innerHTML = data;

      const container = document.getElementById('chat-container');
      container.scrollTop = container.scrollHeight;
    });
}

setInterval(loadMessages, 2000);

loadMessages();