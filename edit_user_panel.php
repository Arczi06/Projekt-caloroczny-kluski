<?php
include 'config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $user['password'];
        }

        $update_sql = "UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssisi", $username, $email, $role, $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            echo "Dane użytkownika zostały zaktualizowane.";
        } else {
            echo "Błąd przy aktualizacji danych.";
        }
    }
}
?>

<form method="POST">
    <label for="username">Login:</label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

    <label for="role">Rola:</label>
    <select name="role">
        <option value="0" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>Czytelnik</option>
        <option value="1" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Bibliotekarz</option>
        <option value="2" <?php echo $user['role'] == 2 ? 'selected' : ''; ?>>Administrator</option>
    </select>

    <label for="password">Hasło:</label>
    <input type="password" name="password" placeholder="Nowe hasło">

    <button type="submit">Zaktualizuj</button>
    <div>
        <a href="admin_panel.php">Powrót do Panelu</a>
    </div>
</form>
