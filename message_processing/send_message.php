<?php
session_start();

include_once '../configurable/connect_to_db.php';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $message = htmlspecialchars($_POST['message']);

    if (!empty($user_id) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
            $stmt->execute([$user_id, $message]);

            header('Location: ../chat.php');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    } else echo 'не дошло';
} else echo 'не пост';

 

print_r($_POST['message']);
print_r($_SESSION);