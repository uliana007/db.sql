<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Если не авторизован — отправить на логин
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель — заявки автомобилей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <style>
        body {
            background-color: rgba(204, 0, 0, 0.1);
        }
        .admin-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            margin: 30px auto;
            max-width: 1000px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .status-select {
            min-width: 130px;
        }
    </style>
</head>
<body>
    <div class="container admin-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Админ-панель — заявки автомобилей</h1>
            <a href="admin_logout.php" class="btn btn-outline-danger">Выйти</a>
        </div>
        <div id="stats" class="mb-3"></div>
        <div id="admin-cart-list"></div>
        <div class="text-end mt-4">
            <a href="home.php" class="btn btn-secondary">Назад на главную</a>
        </div>
    </div>
    <script>
        // Демо-данные автомобилей (тот же массив, что и на главной)
        const cars = [
            {
                id: 1,
                brand: "Toyota",
                model: "Camry",
                year: 2022,
                price: 1700000,
                status: "used",
                images: ["img/camry1.jpg", "img/camry2.jpg"],
                description: "Удобный седан, отличное состояние, 1 владелец."
            },
            {
                id: 2,
                brand: "Hyundai",
                model: "Solaris",
                year: 2023,
                price: 1100000,
                status: "new",
                images: ["img/solaris1.jpg", "img/solaris2.jpg"],
                description: "Новый автомобиль, гарантия 3 года."
            },
            {
                id: 3,
                brand: "BMW",
                model: "X5",
                year: 2021,
                price: 3200000,
                status: "used",
                images: ["img/x5_1.jpg", "img/x5_2.jpg"],
                description: "Премиальный внедорожник, полный привод."
            },
            {
                id: 4,
                brand: "Kia",
                model: "Rio",
                year: 2020,
                price: 950000,
                status: "used",
                images: ["img/rio1.jpg", "img/rio2.jpg"],
                description: "Экономичный и надежный автомобиль."
            }
        ];

        // Для хранения статусов заявок будем использовать localStorage.
        // Формат: { carId1: "approved", carId2: "rejected", ... }
        function getStatuses() {
            return JSON.parse(localStorage.getItem('requests_statuses') || '{}');
        }
        function setStatuses(statuses) {
            localStorage.setItem('requests_statuses', JSON.stringify(statuses));
        }

        function renderAdminCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const container = document.getElementById('admin-cart-list');
            const stats = document.getElementById('stats');
            if (cart.length === 0) {
                stats.innerHTML = '<div class="alert alert-info text-center">Нет заявок на аренду автомобилей</div>';
                container.innerHTML = '';
                return;
            }

            let statuses = getStatuses();

            // Статистика по статусам
            let total = cart.length, approved=0, rejected=0, pending=0;
            cart.forEach(carId => {
                let s = statuses[carId] || 'pending';
                if (s === 'approved') approved++;
                else if (s === 'rejected') rejected++;
                else pending++;
            });
            stats.innerHTML = `
                <b>Всего заявок:</b> ${total}
                <span class="badge bg-secondary ms-2">В рассмотрении: ${pending}</span>
                <span class="badge bg-success ms-2">Одобрено: ${approved}</span>
                <span class="badge bg-danger ms-2">Отклонено: ${rejected}</span>
            `;

            let html = `<table class="table table-bordered align-middle table-hover">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Марка/Модель</th>
                        <th>Год</th>
                        <th>Цена</th>
                        <th>Состояние</th>
                        <th>Описание</th>
                        <th>Статус заявки</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>`;
            cart.forEach(carId => {
                const car = cars.find(c => c.id === carId);
                if (!car) return;
                const statusVal = statuses[carId] || 'pending';
                html += `
                    <tr>
                        <td><img src="${car.images[0]}" alt="${car.brand} ${car.model}" style="width: 80px; border-radius: 8px;"></td>
                        <td>${car.brand} ${car.model}</td>
                        <td>${car.year}</td>
                        <td>${car.price.toLocaleString('ru-RU')} ₽</td>
                        <td>${car.status === 'new' ? "Новый" : "Б/У"}</td>
                        <td>${car.description}</td>
                        <td>
                            <select class="form-select status-select" data-carid="${car.id}">
                                <option value="pending" ${statusVal==='pending'?'selected':''}>В рассмотрении</option>
                                <option value="approved" ${statusVal==='approved'?'selected':''}>Одобрено</option>
                                <option value="rejected" ${statusVal==='rejected'?'selected':''}>Отклонено</option>
                            </select>
                        </td>
                        <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${car.id})">Удалить</button></td>
                    </tr>
                `;
            });
            html += '</tbody></table>';
            container.innerHTML = html;

            // Навесить обработчики изменения статуса
            document.querySelectorAll('.status-select').forEach(sel => {
                sel.addEventListener('change', function() {
                    let statuses = getStatuses();
                    statuses[this.getAttribute('data-carid')] = this.value;
                    setStatuses(statuses);
                    renderAdminCart();
                });
            });
        }

        function removeFromCart(carId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart = cart.filter(id => id !== carId);
            localStorage.setItem('cart', JSON.stringify(cart));
            // Удаляем статус заявки
            let statuses = getStatuses();
            delete statuses[carId];
            setStatuses(statuses);
            renderAdminCart();
        }

        renderAdminCart();
    </script>
</body>
</html>