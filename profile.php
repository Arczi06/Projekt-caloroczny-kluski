<?php
include 'config.php';

$id = $_GET['id'];  // Pobierz ID użytkownika z URL
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $role = $user["role"] == 1 ? "Bibliotekarz" : ($user["role"] == 2 ? "Administrator" : "Czytelnik");
} else {
    echo "Nie znaleziono użytkownika.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <section id="user-profile">
        <h1>Profil użytkownika: <?php echo $user['username']; ?></h1>
        
        <!-- Profil użytkownika -->
        <div class="profile-info">
            <img src="ni/<?php echo $user['profile_image']; ?>" alt="Zdjęcie profilowe" class="profile-img">
            <p><strong>Imię:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Rola:</strong> <?php echo $role; ?></p>
        </div>

        <!-- Kalendarz aktywności (przykładowo, możesz dodać dane z tabeli logów) -->
        <div class="activity-calendar">
            <h2>Aktywność użytkownika</h2>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Przykład pobierania aktywności użytkownika z tabeli logów (możesz dostosować do swojej struktury)
                    $activitySql = "SELECT * FROM user_activity WHERE user_id = $id ORDER BY activity_date DESC";
                    $activityResult = $conn->query($activitySql);

                    if ($activityResult->num_rows > 0) {
                        while ($activity = $activityResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $activity['activity_date'] . "</td>";
                            echo "<td>" . $activity['activity_description'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Brak aktywności użytkownika.</td></tr>";
                    }
                    ?>
                    
                </tbody>
                
            </table>
            <a href="admin_panel.php">powrót</a>
        </div>
    </section>
</body>
</html>
