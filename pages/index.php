<?php
include '../includes/header.php';
include '../config/database.php'; // Подключаем базу данных

// Получаем список фильмов
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../public/css/style.css">


<!-- Блок уведомлений -->
<?php if (!empty($_SESSION['success'])): ?>
    <div class="notification success">
        <?= $_SESSION['success']; ?>
        <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="notification error">
        <?= $_SESSION['error']; ?>
        <button class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="hero">
    <div class="slider">
        <div class="slides">
            <img src="../public/images/godzilla_vs_kong.jpg" class="slide" alt="Кинотеатр 1">
            <img src="../public/images/dune2.jpg" class="slide" alt="Кинотеатр 2">
            <img src="../public/images/venom.jpg" class="slide" alt="Кинотеатр 3">
        </div>
    </div>

    <!-- Контент, который будет поверх -->
    <!-- <div class="hero-content">
        <h1>Добро пожаловать в наш кинотеатр!</h1>
        <p>Ощути магию кино на большом экране</p>
        <a href="#movies" class="btn">Посмотреть расписание</a>
    </div> -->

    <!-- Кнопки управления слайдером -->
    <button class="prev-btn">&#10094;</button>
    <button class="next-btn">&#10095;</button>
</div>

<script src="../public/js/slider.js"></script>

<section class="movies" id="movies">
    <div class="marquee">
        <h2> Сейчас в кино • Сейчас в кино • Сейчас в кино • Сейчас в кино •</h2>
    </div>
    <div class="movie-list">
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <img src="../public/images/<?= htmlspecialchars($movie['poster']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                    <p><?= htmlspecialchars($movie['description']) ?></p>
                    <p>Длительность: <?= htmlspecialchars($movie['duration']) ?> мин</p>
                    <button class="btn book-btn" data-movie-id="<?= $movie['id'] ?>" data-movie-title="<?= htmlspecialchars($movie['title']) ?>">Забронировать билеты</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>В данный момент нет доступных фильмов.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Модальное окно бронирования -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <h2>Выберите количество мест для бронирования</h2>
        <form id="bookingForm" action="../process/process_booking.php" method="POST">
            <input type="hidden" id="movieId" name="movie_id">

            <label for="tickets">Количество билетов:</label>
            <input type="number" id="tickets" name="tickets" min="1" value="1" required>

            <label for="show_time">Время сеанса:</label>
            <select id="show_time" name="show_time" required>
                <option value="12:00">12:00</option>
                <option value="15:00">15:00</option>
                <option value="18:00">18:00</option>
                <option value="21:00">21:00</option>
            </select>

            <label>Выберите места:</label>
            <div class="seating-chart" id="seatingChart"></div>
            <input type="hidden" id="seat_numbers" name="seat_numbers" required>

            <button type="submit" class="btn">Подтвердить</button>
        </form>
    </div>
</div>

<script src="../public/js/seating.js"></script>

<script src="../public/js/script.js"></script>

<?php include '../includes/footer.php'; ?>
