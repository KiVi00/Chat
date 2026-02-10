<?php
session_start();
include_once '../configurable/connect_to_db.php';

$current_user_id = $_SESSION['user_id'] ?? null;

$stmt = $pdo->query("SELECT m.user_id, m.message, m.created_at, u.username 
FROM messages m 
LEFT JOIN users u 
ON m.user_id = u.user_id 
ORDER BY m.created_at 
DESC LIMIT 50");

$messages = $stmt->fetchAll();

foreach (array_reverse($messages) as $msg): $is_own = $current_user_id == $msg['user_id'];?>
    <div class="message <?= $is_own ? 'own' : '' ?>">
        <?php if(!$is_own): ?>
            <div class="time"><?= date('H:i', strtotime($msg['created_at'])) ?></div>
            <div class="author">
                <?= $msg['username'] ?>
            </div>
        <?php endif; ?>
        <div class="text"><?= nl2br($msg['message']) ?></div>
        <?php if($is_own):?>
            <div class="time-right"><?= date('H:i', strtotime($msg['created_at'])) ?></div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>