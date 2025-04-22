<?php 
include '../includes/header.php'; 
?>

<div class="register-container" style="margin-top: 100px;">
    <h2 style="text-align: center; margin-bottom: 20px;">Регистрация</h2>
    
    <?php 
    // Вывод сообщения об ошибке
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-error'>" . htmlspecialchars($_SESSION['error']) . "</div>";
        unset($_SESSION['error']);
    }
    
    // Вывод сообщения об успешной регистрации
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
        
        unset($_SESSION['success']);
    }
    ?>

    <form action="../process/register_process.php" method="post" style="max-width: 400px; margin: 0 auto;">
        <input type="text" name="username" placeholder="Логин" required 
               value="<?= isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : '' ?>">
        <input type="email" name="email" placeholder="Email" required 
               value="<?= isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : '' ?>">
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required>
        <input type="submit" value="Зарегистрироваться">
    </form>

    <p style="text-align: center; margin-top: 20px;">Уже есть аккаунт? <a href="login.php">Войти</a></p>
</div>

<?php 
// Очищаем сохраненные данные формы
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
}
include '../includes/footer.php'; 
?>