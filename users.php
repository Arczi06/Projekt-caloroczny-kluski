<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Użytkownicy</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="logo"></div>
        <ul>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="users.php" class="active">Użytkownicy</a></li>
            <li><a href="#books">Książki</a></li>
            <li><a href="#roles">Rola do zaakceptowania</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="card"> 
            <h3>Użytkownicy</h3>
            <p>Liczba: <span id="userCount">
                <?php
                    include 'config.php';
                    $result = $conn->query("SELECT COUNT(*) AS count FROM users");
                    $row = $result->fetch_assoc();
                    echo $row['count']; 
                ?>
            </span></p>
        </div>
    </div>

    <section id="users">
        <h2>Zarządzanie Użytkownikami</h2>
        <p>Wyszukaj użytkowników:</p>
        <form method="GET" action="users.php">
            <input type="text" name="search" placeholder="Szukaj użytkowników..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Szukaj</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Rola</th>
                    <th>Data Rejestracji</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                $sql = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ? ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
                $search_term = "%$search%";
                $stmt->bind_param("ss", $search_term, $search_term);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $role = $row["role"] == 1 ? "Bibliotekarz" : ($row["role"] == 2 ? "Administrator" : "Czytelnik");
                        echo "<tr>";
                        
                        echo "<td><a href='profilee.php?id=" . $row["id"] . "'>" . $row["username"] . "</a></td>";
                        
                        echo "<td>" . $row["email"] . "</td>";
                        
                        echo "<td>" . $role . "</td>";
                        
                        echo "<td>
                                <a href='edit_user_panel.php?id=" . $row["id"] . "'>Edytuj</a> | 
                                <a href='delete_user.php?id=" . $row["id"] . "'>Usuń</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Brak użytkowników.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

</body>
</html>
