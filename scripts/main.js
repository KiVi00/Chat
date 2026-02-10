'use strict';

let isFirstLoad = true;

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
        loadMessages(true);
      })
      .catch(error => console.error('Ошибка:', error));
  });
}

function loadMessages(shouldScroll = false) {
  fetch('message_processing/get_messages.php', { credentials: 'include' })
    .then(response => response.text())
    .then(data => {
      document.getElementById('chat-container').innerHTML = data;
      
      if (isFirstLoad || shouldScroll) {
        scrollToBottom();
        isFirstLoad = false;
      }
    });
}

function scrollToBottom() {
  const container = document.getElementById('chat-container');
  if (!container) return;
  
  setTimeout(() => {
    container.scrollTop = container.scrollHeight;
  }, 10);
}

setInterval(() => loadMessages(false), 2000);

document.addEventListener('DOMContentLoaded', function() {
  loadMessages(true);
});