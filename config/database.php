<?php
$host = '127.0.0.1';
$port = '5433'; // Если у тебя нестандартный порт (по умолчанию 5432)
$dbname = 'cinema';
$user = 'postgres';
$password = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
