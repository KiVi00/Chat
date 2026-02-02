<?php

function validateCsrfToken($token)
{
  if (empty($_SESSION['csrf_token']) || empty($token)) {
    return false;
  }

  // Простая проверка
  if ($_SESSION['csrf_token'] !== $token) {
    return false;
  }

  unset($_SESSION['csrf_token']);
  return true;
}
