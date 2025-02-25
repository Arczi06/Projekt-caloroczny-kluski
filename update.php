<?php
$dbhost = 'localhost'; 
$dbname = 'products';
$dbuser = 'root';
$dbpass = '';
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn) {
    die('Brak połączenia z bazą danych!!!<br>' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Tabelka.css">
</head>
<body>
    <form action="update.php?actin=update&amp;id=" method="post">
        <div>
            <div><label>Id</label><input type="number" name="find[id]"></div>
            <div><label>Nazwa</label><input type="text" name="find[prod_name]"></div>
            <div><label>Cena</label><input type="number" name="find[price]"></div>
            <div><label>Ilosc</label><input type="number" name="find[quantity]"></div>
            <div><input type="submit"></div>
        </div>
    </form>
</body>
</html>