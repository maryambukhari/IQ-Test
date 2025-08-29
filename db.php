<?php
$host = 'localhost'; // Assuming localhost; replace with actual host if remote (e.g., AWS RDS endpoint)
$dbname = 'dbrfx94zycxw5e';
$username = 'uxhc7qjwxxfub';
$password = 'g4t0vezqttq6';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
