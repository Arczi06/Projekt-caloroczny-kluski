<?php
function assignMessageClass($messages, $conn) {
    foreach ($messages as $key => $message) { 
        $userId = $message['user_id'];
        $sql = "SELECT message_color FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($messageColor);
        $stmt->fetch();
        
        $messages[$key]['class'] = "message" . $userId; 
        $messages[$key]['messageColor'] = $messageColor; 
        $stmt->close();
    }
    $messageHtml = '';

    foreach ($messages as $message) {
        $messageHtml .= '<div class="message" style="border-color: ' . htmlspecialchars($message['messageColor']) . ';">
                            <span>' . htmlspecialchars($message['username']) . '</span>: ' . htmlspecialchars($message['message']) . '</div>';
    }

    return $messageHtml;
}
?>
