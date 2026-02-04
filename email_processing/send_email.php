<?php
session_start();

require '../vendor/autoload.php';
include_once '../utility/checkAuth.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$mail = new PHPMailer(true);

$dotenv = Dotenv::createImmutable(__DIR__ . '\..');
$dotenv->load();

$code = random_int(100000, 999999);
$_SESSION['verification_code'] = $code;

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vinogradovkirill123@gmail.com';
    $mail->Password = $_ENV['APP_PASSWORD']; // Заменить на пароль от приложения (gmail, яндекс и др.)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('vinogradovkirill123@gmail.com', 'Чат');
    $mail->addAddress($_SESSION['email'], 'Крот');

    $mail->isHTML(true);
    $mail->Subject = 'Подтверждение email';
    $mail->Body = "<h1>Код подтверждения: $code</h1>";
    $mail->AltBody = "<h1>Код подтверждения: $code</h1>";

    $mail->send();
    
    $_SESSION['notification'] = 'Письмо успешно отправлено!';
    header('Location: ../chat.php');
    exit;
} catch (Exception $e) {
    echo "Ошибка отправки: {$mail->ErrorInfo}";
}