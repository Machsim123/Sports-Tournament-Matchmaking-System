<?php
$servername = "localhost";
$username = "root";
$password = ""; // Parola implicită pentru XAMPP
$dbname = "compsport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>
