<?php 
session_start(); 
require "db.php"; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $login = $_POST['login']; 
    $password = $_POST['password']; 
    $stmt = $pdo->prepare("SELECT * FROM user WHERE login = ? AND password = ?"); 
    $stmt->execute([$login, $password]); 
    $user = $stmt->fetch(); 
    if ($user) { 
        $_SESSION['user_id'] = $user['id']; 
        header("Location: home.php"); 
        exit; 
    } else { 
        $error = "Ошибка при вводе логина или пароля"; 
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Авторизация</h2>
        <form method="POST" class="form-container">
            <div class="mb-3">
                <input type="text" name="login" class="form-control rounded-pill" placeholder="Логин" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control rounded-pill" placeholder="Пароль" required>
            </div>
            <button type="submit" class="btn btn-lg rounded-pill w-100">Войти</button>
            <a href="register.php" class="d-block text-center mt-3">Зарегистрироваться</a>
            <?php if (!empty($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?> 
            
        </form>
       
    </div>
</body>
</html>