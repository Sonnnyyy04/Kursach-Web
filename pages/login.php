<?php include '../includes/header.php'; ?>
<div class="login-container" style="margin-top: 200px;">
<h2 style="text-align: center">Вход</h2>

<?php 

if (isset($_GET['error'])) {
    echo "<p style='color: red; text-align: center; margin-top: 20px; font-size: 20px; '>" . htmlspecialchars($_GET['error']) . "</p>";
}
?>

<form action="../process/login_process.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="submit" value="Войти">
</form>

<p>Еще нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
</div>
<?php include '../includes/footer.php'; ?>
