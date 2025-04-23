<?php
function loadCSS($conn) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT role FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row['role'];
            if ($role == 0) {
                return 'reader.css';
            } elseif ($role == 1) {
                return 'librarian.css';
            } elseif ($role == 2) {
                return 'librarian.css';
            } else {
                return 'b_messages.css';
            }
        } else {
            return 'b_messages.css';
        }
    } else {
        return 'b_messages.css';
    }
}
?>