<?php
include 'config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = intval($_POST['role']);
        $password = $_POST['password'];

        $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

        $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id = ?");
        $update_stmt->bind_param("ssisi", $username, $email, $role, $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "username" => $username,
                "email" => $email,
                "role" => $role
            ]);
        } else {
            echo json_encode(["status" => "error"]);
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Użytkownika</title>
    <link rel="stylesheet" href="edit.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Edycja Użytkownika</h2>

    <div id="message"></div>
    <form id="edit-form" class="edit-form">
        <div class="form-group">
            <label for="username">Login:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="role">Rola:</label>
            <select name="role" id="role">
                <option value="0" <?php echo $user['role'] == 0 ? 'selected' : ''; ?>>Czytelnik</option>
                <option value="1" <?php echo $user['role'] == 1 ? 'selected' : ''; ?>>Bibliotekarz</option>
                <option value="2" <?php echo $user['role'] == 2 ? 'selected' : ''; ?>>Administrator</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Nowe Hasło (opcjonalnie):</label>
            <input type="password" name="password" id="password" placeholder="Wpisz nowe hasło">
        </div>

        <button type="submit" class="btn">Zaktualizuj</button>
    </form>

    <div class="back-link">
        <a href="users.php">← Powrót do Panelu</a>
    </div>
</div>

<script>
$(document).ready(function () {
    $("#edit-form").on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: window.location.href,
            data: $(this).serialize() + "&ajax=1",
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#message").html("<p class='success'>Dane zaktualizowane!</p>");
                    $("#username").val(response.username);
                    $("#email").val(response.email);
                    $("#role").val(response.role);
                    
                    $("#password").val("");
                } else {
                    $("#message").html("<p class='error'>Błąd przy aktualizacji.</p>");
                }
            }
        });
    });
});
</script>

</body>
</html>
