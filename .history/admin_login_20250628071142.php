<?php 
session_start(); 

// Если уже авторизован как админ — перенаправляем сразу в админку
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: admin.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $login = $_POST['login']; 
    $password = $_POST['password']; 
    // Жестко заданные логин и пароль для админки
    if ($login === 'ульяна007' && $password === '123456789') { 
        $_SESSION['is_admin'] = true;
        header("Location: admin.php"); 
        exit; 
    } else { 
        $error = "Ошибка при вводе логина или пароля для админ-панели"; 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Авторизация администратора</h2>
        <form method="POST" class="form-container" style="max-width:400px;margin:auto;">
            <div class="mb-3">
                <input type="text" name="login" class="form-control rounded-pill" placeholder="Логин администратора" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control rounded-pill" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn-lg rounded-pill w-100 btn-primary">Войти</button>
            <?php if (!empty($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?> 
        </form>
        <div class="text-center mt-3">
            <a href="home.php">Вернуться на главную</a>
        </div>
    </div>
</body>
</html>