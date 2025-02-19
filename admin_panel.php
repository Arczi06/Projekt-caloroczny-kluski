<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="logo"></div>
        <ul>
            <li><a href="admin_panel.php" class="active">Admin Panel</a></li>
            <li><a href="users.php">Użytkownicy</a></li>
            <li><a href="#books">Książki</a></li>
            <li><a href="#roles">Rola do zaakceptowania</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
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
        <div class="card">
            <h3>Książki</h3>
            <p>Liczba: <span id="bookCount">
                <?php
                    $result = $conn->query("SELECT COUNT(*) AS count FROM borrowed_books");
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                ?>
            </span></p>
        </div>
    </div>

    <section id="users">
        <h2>Zarządzanie Użytkownikami</h2>
        <p>Wyświetlane są 5 najnowsze użytkowników:</p>
        <table>
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Rola</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $role = $row["role"] == 1 ? "Bibliotekarz" : ($row["role"] == 2 ? "Administrator" : "Czytelnik");
                            echo "<tr>";
                            
                            echo "<td><a href='profile.php?id=" . $row["id"] . "'>" . $row["username"] . "</a></td>";
                            
                            echo "<td>" . $row["email"] . "</td>";
                            
                            echo "<td>" . $role . "</td>";
                            
                            echo "<td>
                                    <a href='edit_user_panel.php?id=" . $row["id"] . "'>Edytuj</a> | 
                                    <a href='delete_user.php?id=" . $row["id"] . "'>Usuń</a>
                                </td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        <button class="btn-more" onclick="window.location.href='users.php'">Zobacz więcej</button>
    </section>

    <section id="books">
        <h2>Zarządzanie Książkami</h2>
        <p>Wyświetlane są 5 najnowsze książki:</p>
        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Data Wypożyczenia</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM borrowed_books ORDER BY borrow_date DESC LIMIT 5";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["author"] . "</td>";
                        echo "<td>" . $row["borrow_date"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td><a href='update_book_status.php?id=" . $row["id"] . "'>Zaktualizuj</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn-more" onclick="window.location.href='books.html'">Zobacz więcej</button>
    </section>

    <section id="pendingUsers">
    <h2 id="pendingTitle">Oczekujący użytkownicy</h2>
    <div class="pending-cards">
        <?php
        $sql_total = "SELECT COUNT(*) as total FROM pending_users WHERE status != 'rejected'";
        $result_total = $conn->query($sql_total);
        $total_pending = $result_total->fetch_assoc()['total'];

        if ($total_pending > 3) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let title = document.getElementById('pendingTitle');
                        title.classList.add('alert-title');
                    });
                  </script>";
        }

        $sql = "SELECT * FROM pending_users WHERE status != 'rejected' LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $role = $row["role"] == 1 ? "Bibliotekarz" : ($row["role"] == 2 ? "Administrator" : "Czytelnik");

                echo "<div class='pending-card'>";
                echo "<h3>" . $row["username"] . "</h3>";
                echo "<p>Email: " . $row["email"] . "</p>";
                echo "<p>Rola: " . $role . "</p>";
                echo "<p>Data rejestracji: " . $row["date_submitted"] . "</p>";
                echo "<div class='actions'>";
                echo "<a href='accept_user.php?id=" . $row["id"] . "' class='accept-btn'>Akceptuj</a>";
                echo "<a href='reject_user.php?id=" . $row["id"] . "' class='reject-btn'>Odrzuć</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Brak oczekujących użytkowników.</p>";
        }
        ?>
    </div>
</section>


</div>

</section>

</body>
</html>
