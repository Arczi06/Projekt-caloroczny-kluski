<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $profile_image);
$stmt->fetch();
$stmt->close();

$profile_image_path = isset($profile_image) && $profile_image ? "ni/$profile_image" : "ni/default.jpg";

$users_sql = "SELECT id, username, email, role FROM users ORDER BY id DESC";
$users_result = $conn->query($users_sql);

function getRoleDetails($role) {
    switch ($role) {
        case 0:
            return ["Czytelnik", "role-user", "fas fa-book"];
        case 1:
            return ["Bibliotekarz", "role-librarian", "fas fa-user-tie"];
        case 2:
            return ["Administrator", "role-admin", "fas fa-user-shield"];
        default:
            return ["Nieznana rola", "role-unknown", "fas fa-question"];
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownicy</title>
    <link rel="stylesheet" href="biblio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="biblio_users.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <?php include 'biblio_sidebar.php'; ?>

        <main class="dashboard-content">
            <header class="dashboard-header">
                <div class="user-info">
                    <img src="<?php echo $profile_image_path; ?>" alt="Profile Image" class="user-avatar">
                    <span class="user-name">Witaj, <?php echo htmlspecialchars($username); ?>!</span>
                </div>
            </header>

            <section class="dashboard-section">
                <h2>Lista użytkowników</h2>
                <div class="table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th class="sortable" data-column="name">Nazwa</th>
                                <th class="sortable" data-column="email">E-mail</th>
                                <th class="sortable" data-column="role">Rola</th>
                                <th>Profil</th> <!-- Bez sortowania -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $users_result->fetch_assoc()) : 
                                list($roleName, $roleClass, $roleIcon) = getRoleDetails($row['role']);
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><span class="role <?php echo $roleClass; ?>"><i class="<?php echo $roleIcon; ?>"></i> <?php echo $roleName; ?></span></td>
                                    <td><a href="biblio_profile.php?id=<?php echo $row['id']; ?>" class="profile-link">Zobacz profil</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
