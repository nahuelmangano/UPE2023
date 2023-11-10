<?php
// Conexión a la base de datos -... poner en archivo aparte
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backendlp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

?>