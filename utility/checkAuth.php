<?php
if (!isset($_SESSION['user_id'])) {
  $_SESSION['error'] = 'Вы не авторизованы!';
  header('Location: index.php');
  exit;
}