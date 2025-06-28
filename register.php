<?php require 'db.php'; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $registration_date = $_POST['registration_date'];
    echo 'user';
    $stmt = $pdo->prepare("INSERT INTO user (full_name, phone, email, login, password, registration_date) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $phone, $email, $login, $password, $registration_date]);
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center">
            <img src="img/i.jpg" alt="Image" class="rounded mb-4" width="200">
        </div>
        <h2 class="text-center">Регистрация</h2>
        <form method="POST" class="form-container">
            <div class="mb-3">
                <input type="text" name="full_name" class="form-control rounded-pill" placeholder="ФИО" required>
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control rounded-pill" placeholder="Телефон" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control rounded-pill" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="login" class="form-control rounded-pill" placeholder="Логин" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control rounded-pill" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn-lg rounded-pill w-100">Зарегистрироваться</button>
        </form>
    </div>
</body>
</html>