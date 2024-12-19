<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;

            $currentDate = date('Y-m-d');
            $sqlActivity = "SELECT login_count FROM user_activity WHERE user_id = ? AND activity_date = ?";
            $stmtActivity = $conn->prepare($sqlActivity);
            $stmtActivity->bind_param("is", $id, $currentDate);
            $stmtActivity->execute();
            $stmtActivity->store_result();

            if ($stmtActivity->num_rows > 0) {
                $stmtActivity->bind_result($loginCount);
                $stmtActivity->fetch();
                $newLoginCount = $loginCount + 1;
                
                $updateSql = "UPDATE user_activity SET login_count = ? WHERE user_id = ? AND activity_date = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("iis", $newLoginCount, $id, $currentDate);
                $updateStmt->execute();
            } else {
                $insertSql = "INSERT INTO user_activity (user_id, activity_date, login_time, login_count) VALUES (?, ?, NOW(), 1)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("is", $id, $currentDate);
                $insertStmt->execute();
            }

            header("Location: dashboard.php");
        } else {
            echo "Invalid password! or username";
        }
    } else {
        echo "Invalid username! or username";
    }
    $stmt->close();
    $conn->close();
}
?>
