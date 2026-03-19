<?php
$host = 'mysql-container';
$db   = 'lab2db';
$user = 'lab2user';
$pass = 'lab2pass';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>