<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование тренировки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: rgba(204, 0, 0, 0.1); /* Полупрозрачный красный фон */
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.8); /* Белый полупрозрачный фон для формы */
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: 50px auto;
        }
        .btn-submit {
            background-color: #D32F2F;
            border: none;
            color: white;
            border-radius: 25px;
        }
        .btn-submit:hover {
            background-color: #C2185B;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Забронировать тренировку</h2>
            <form action="submit_booking.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="training" class="form-label">Выберите тренировку</label>
                    <select class="form-select" id="training" name="training" required>
                        <option value="yoga">Йога</option>
                        <option value="strength">Силовая тренировка</option>
                        <option value="cardio">Кардио тренировка</option>
                        <option value="pilates">Пилатес</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-submit btn-block">Забронировать</button>
            </form>
        </div>
    </div>
</body>
</html>