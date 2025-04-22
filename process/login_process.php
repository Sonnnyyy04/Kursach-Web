<?php
require '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Записываем пользователя в сессию
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        header("Location: ../pages/profile.php"); // Перенаправляем в личный кабинет
        exit();
    } else {
        header("Location: ../pages/login.php?error=" . urlencode("Неверный email или пароль!"));
        exit();
    }
}
?>
