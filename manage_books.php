<?php
$servername = "localhost";
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "login_db(1)"; // Use the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO books (title, author) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $author);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Book added successfully."]);
    } else {
        echo json_encode(["message" => "Error adding book."]);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book-id'];
    $newTitle = $_POST['new-title'];
    $newAuthor = $_POST['new-author'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE books SET title = ?, author = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newTitle, $newAuthor, $bookId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Book updated successfully."]);
    } else {
        echo json_encode(["message" => "Error updating book."]);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book-id'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $bookId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["message" => "Book deleted successfully."]);
    } else {
        echo json_encode(["message" => "Error deleting book."]);
    }
    $stmt->close();
}

// Fetch books from the database
$sql = "SELECT id, title, author FROM books"; // Adjust the query as per your database structure



$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Return the list of books as JSON
echo json_encode($books);

?>
