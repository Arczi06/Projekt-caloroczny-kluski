<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// pobieranie tych wiadomosci ? z bazy danych
$sql1 = "SELECT * FROM dane_ksiazek where klasa = 1";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM dane_ksiazek where klasa = 2";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM dane_ksiazek where klasa = 3";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM dane_ksiazek where klasa = 4";
$result4 = $conn->query($sql4);

$sql5 = "SELECT * FROM dane_ksiazek where klasa = 5";
$result5 = $conn->query($sql5);

$sql6 = "SELECT * FROM dane_ksiazek where klasa = 6";
$result6 = $conn->query($sql6);

$sql7 = "SELECT * FROM dane_ksiazek where klasa = 7";
$result7 = $conn->query($sql7);

$sql8 = "SELECT * FROM dane_ksiazek where klasa = 8";
$result8 = $conn->query($sql8);

$sql9 = "SELECT * FROM dane_ksiazek where klasa = 9";
$result9 = $conn->query($sql9);

$sql10 = "SELECT * FROM dane_ksiazek where klasa = 10";
$result10 = $conn->query($sql10);

$sql11 = "SELECT * FROM dane_ksiazek where klasa = 11";
$result11 = $conn->query($sql11);

$sql12 = "SELECT * FROM dane_ksiazek where klasa = 12";
$result12 = $conn->query($sql12);

$sql13 = "SELECT * FROM dane_ksiazek where klasa = 13";
$result13 = $conn->query($sql13);

