<?php
session_start();

// Если уже авторизован как админ — перенаправить в админку
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($login === 'ульяна007' && $password === '123456789') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Неверный логин или пароль для админ-панели";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админ-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Вход в админ-панель</h2>
    <form method="POST" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <input type="text" name="login" class="form-control rounded-pill" placeholder="Логин" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control rounded-pill" placeholder="Пароль" required>
        </div>
        <button type="submit" class="btn btn-lg rounded-pill w-100 btn-dark">Войти</button>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php endif; ?>
        <div class="text-center mt-3"><a href="home.php">Назад на главную</a></div>
    </form>
</div>
</body>
</html>