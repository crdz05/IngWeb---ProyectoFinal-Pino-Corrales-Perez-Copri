<?php
// config/db.php
$host = 'localhost';
$db   = 'app_musical';   // luego la creas en phpMyAdmin con este nombre
$user = 'root';
$pass = '';              // en XAMPP por defecto está vacío

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
