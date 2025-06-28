<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: rgba(204, 0, 0, 0.1); /* Полупрозрачный красный фон */
        }
        .navbar {
            background-color: rgba(138, 24, 24, 0.7); /* Полупрозрачный красный */
        }
        .navbar-brand {
            color: #fff;
        }
        .navbar-nav {
            justify-content: center; /* Выравнивание вкладок по центру */
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .carousel-item img {
            border-radius: 20px;
            width: 400px; /* Уменьшаем размер слайдшоу */
            height: 500px;
            object-fit: cover;
            margin: 0 auto;
        }
        .carousel-inner {
            display: flex;
            justify-content: center;
        }
        .carousel-item {
            display: flex;
            justify-content: center;
        }
        .carousel {
            max-width: 400px; /* Ограничиваем ширину */
            margin: 0 auto; /* Центрируем слайдшоу */
        }
        .text-center p {
            font-family: monospace;
            font-size: 24px;
            color: #D32F2F; /* Красный для текста */
        }
        .btn-outline-primary {
            background-color: #D32F2F; /* Красный цвет кнопки */
            border-color: #D32F2F;
            color: white;
        }
        .btn-outline-primary:hover {
            background-color: #C2185B; /* При наведении на красный оттенок */
            border-color: #C2185B;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="login.php">ТренируйсяPRO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- Центрируем меню -->
                    <li class="nav-item"><a class="nav-link active" href="register.php">Выход</a></li>
                    <li class="nav-item"><a class="nav-link" href="bron.php">Бронь</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">О компании</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            <img src="img/фото1.jpg" alt="Image" class="rounded mb-4" width="500">
        </div>
       

<div class="text-center my-4">
        <p>Приходите к нам в зал!!!</p>
        <a href="bron.php" class="btn btn-outline-primary rounded-pill">Записаться</a>
    </div>
</body>
</html>