<?php
include_once '../configurable/connect_to_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);
    
    if (!empty($username) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $stmt->execute([$username, $message]);
    }
}
?>