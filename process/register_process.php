<?php
session_start();
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Очищаем предыдущие сообщения
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    // Проверяем, совпадают ли пароли
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Пароли не совпадают!";
        header("Location: ../pages/register.php");
        exit();
    }

    // Проверяем длину пароля
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Пароль должен быть минимум 6 символов!";
        header("Location: ../pages/register.php");
        exit();
    }

    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Проверяем, есть ли уже такой email
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Email уже зарегистрирован!";
            header("Location: ../pages/register.php");
            exit();
        }

        // Проверяем, есть ли уже такой username
        $stmt = $pdo->prepare("SELECT id FROM users WHERE name = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Имя пользователя уже занято!";
            header("Location: ../pages/register.php");
            exit();
        }

        // Записываем нового пользователя
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ]);

        $_SESSION['success'] = "Регистрация прошла успешно!";
        $_SESSION['registered_email'] = $email; // Можно сохранить email для автозаполнения на странице входа
        header("Location: ../pages/register.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка базы данных: " . $e->getMessage();
        header("Location: ../pages/register.php");
        exit();
    }
}
?>