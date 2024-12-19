<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LEKTURY";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// pobieranie tych wiadomosci ? z bazy danych
$sql1 = "SELECT * FROM Klasa1";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM Klasa2";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM Klasa3";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM Klasa4";
$result4 = $conn->query($sql4);

$sql5 = "SELECT * FROM Klasa5";
$result5 = $conn->query($sql5);

$sql6 = "SELECT * FROM Klasa6";
$result6 = $conn->query($sql6);

$sql7 = "SELECT * FROM Klasa7";
$result7 = $conn->query($sql7);

$sql8 = "SELECT * FROM Klasa8";
$result8 = $conn->query($sql8);

$sqlS1 = "SELECT * FROM KlasaS1";
$resultS1 = $conn->query($sqlS1);

$sqlS2 = "SELECT * FROM KlasaS2";
$resultS2 = $conn->query($sqlS2);

$sqlS3 = "SELECT * FROM KlasaS3";
$resultS3 = $conn->query($sqlS3);

$sqlS4 = "SELECT * FROM KlasaS4";
$resultS4 = $conn->query($sqlS4);

$sqlS5 = "SELECT * FROM KlasaS5";
$resultS5 = $conn->query($sqlS5);