<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кинотеатр</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
<header>
    <a href="../pages/index.php" class="logo">
        <img src="../public/images/logo.jpg" alt="Кинотеатр" width="150">
    </a>
    <nav>
        <a href="../pages/index.php">Главная</a>
        <a href="../pages/profile.php">Личный кабинет</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="../process/logout.php">Выход</a>
        <?php else: ?>
            <a href="../pages/register.php">Регистрация</a>
        <?php endif; ?>
    </nav>
</header>
<script src="../public/js/header.js"></script>
<main>
