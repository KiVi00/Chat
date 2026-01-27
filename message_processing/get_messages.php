<?php
include_once '../configurable/connect_to_db.php';

$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 50");
$messages = $stmt->fetchAll();

foreach (array_reverse($messages) as $msg): ?>
    <div class="message">
        <div class="author"><?= $msg['username'] ?> 
            <span class="time"><?= date('H:i', strtotime($msg['created_at'])) ?></span>
        </div>
        <div class="text"><?= nl2br($msg['message']) ?></div>
    </div>
<?php endforeach; ?>