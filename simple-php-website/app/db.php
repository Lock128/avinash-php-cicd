<?php
$host = '127.0.0.1';
$db   = 'sampledb';
$user = 'root';
$pass = 'password'; // This must match init.sql

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

?>
