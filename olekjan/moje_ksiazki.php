<?php
session_start();
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lektury";

// Połączenie z bazą
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Błąd połączenia: " . $conn->connect_error]));
}

// Sprawdzenie czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Użytkownik nie jest zalogowany."]);
    exit;
}

$userId = intval($_SESSION['user_id']);

// Pobranie książek przypisanych do użytkownika z tabeli rere
$sql = "SELECT id, title, author FROM rere WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode(["success" => true, "books" => $books]);

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje książki</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <h1>Moje książki</h1>
    <div id="bookList">Ładowanie książek...</div>

    <script>
        async function fetchBooks() {
            try {
                const response = await fetch('moje-ksiazki.php');
                const data = await response.json();

                const bookList = document.getElementById('bookList');

                if (!data.success) {
                    bookList.innerHTML = `<p>${data.error}</p>`;
                    return;
                }

                if (data.books.length === 0) {
                    bookList.innerHTML = "<p>Brak przypisanych książek.</p>";
                    return;
                }

                const list = document.createElement('ul');
                data.books.forEach(book => {
                    const item = document.createElement('li');
                    item.textContent = `${book.title} — ${book.author}`;
                    list.appendChild(item);
                });

                bookList.innerHTML = "";
                bookList.appendChild(list);
            } catch (error) {
                console.error('Błąd podczas ładowania książek:', error);
                document.getElementById('bookList').innerHTML = '<p>Wystąpił błąd podczas ładowania książek.</p>';
            }
        }

        fetchBooks();
    </script>
</body>
</html>
