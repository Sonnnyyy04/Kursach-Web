<?php 
include '../includes/header.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
include '../config/database.php';

// Получение данных пользователя
$query = "SELECT name, email FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Получение списка забронированных мест
$query = "SELECT movies.title, bookings.seat_number, bookings.show_time 
          FROM bookings 
          JOIN movies ON bookings.movie_id = movies.id 
          WHERE bookings.user_id = ?
          ORDER BY bookings.show_time DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="profile-container">
    <h2>Личный кабинет</h2>
    <div class="profile-card">
        <h3>👤 Привет, <?= htmlspecialchars($user['name']) ?>!</h3>
        <h4>📧 Email: <?= htmlspecialchars($user['email']) ?></h4>
    </div>

    <div class="section">
        <h3>🎟️ Забронированные места</h3>
        <?php if (count($bookings) > 0): ?>
            <ul>
                <?php foreach ($bookings as $booking): ?>
                    <li>
                        <p>
                            <strong><?= htmlspecialchars($booking['title']) ?></strong> - 
                            Место: <?= htmlspecialchars($booking['seat_number']) ?>, 
                            Время: <?= htmlspecialchars($booking['show_time']) ?>
                            </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <h4>У вас нет забронированных мест.</h4>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
