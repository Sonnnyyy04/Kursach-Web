<?php
include '../config/database.php';
session_start(); // Запускаем сессию

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'] ?? null;
    $movie_id = $_POST['movie_id'] ?? null;
    $tickets = isset($_POST['tickets']) ? (int)$_POST['tickets'] : null;
    $show_time = $_POST['show_time'] ?? null;
    $seat_numbers = $_POST['seat_numbers'] ?? null;

    if ($user_id && $movie_id && $tickets > 0 && $show_time && $seat_numbers) {
        $seat_numbers_array = array_map('trim', explode(',', $seat_numbers));

        if (count($seat_numbers_array) !== $tickets) {
            $_SESSION['error'] = "Количество мест не совпадает с количеством билетов!";
            header("Location: ../pages/index.php");
            exit();
        }

        $current_date = date('Y-m-d');
        $full_show_time = "$current_date $show_time:00"; // Приводим к формату TIMESTAMP

        // Проверяем, заняты ли указанные места
        $placeholders = implode(',', array_fill(0, count($seat_numbers_array), '?'));
        $check_stmt = $pdo->prepare("SELECT seat_number FROM bookings WHERE movie_id = ? AND show_time = ? AND seat_number IN ($placeholders)");
        $check_stmt->execute(array_merge([$movie_id, $full_show_time], $seat_numbers_array));
        $taken_seats = $check_stmt->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($taken_seats)) {
            $_SESSION['error'] = "Места " . implode(', ', $taken_seats) . " уже заняты!";
            header("Location: ../pages/index.php");
            exit();
        }

        // Вставляем каждое место как отдельную запись
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, movie_id, seat_number, show_time) VALUES (?, ?, ?, ?)");
        
        foreach ($seat_numbers_array as $seat) {
            $stmt->execute([$user_id, $movie_id, $seat, $full_show_time]);
        }

        $_SESSION['success'] = "Бронирование успешно оформлено!";
        header("Location: ../pages/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Ошибка! Проверьте введённые данные.";
        header("Location: ../pages/index.php");
        exit();
    }
}
?>
