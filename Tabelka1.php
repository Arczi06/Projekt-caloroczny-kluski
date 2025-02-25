<?php
$dbhost = "localhost"; 
$dbname = "products";
$dbuser = "root";
$dbpass = "";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($conn->connect_error) {
    die("Brak połączenia z bazą danych!!!<br>" . $conn->connect_error);
}
?> 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$query = "SELECT * FROM products";
$result = $conn->query($query);
if ($result->num_rows > 0) {
?>
    <table>
<?php
    while($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['prod_name'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['quantity'] ?></td>
        </tr>
<?php
    }
?>
    </table>
<?php
}
$conn->close();
?>
</body>
</html>