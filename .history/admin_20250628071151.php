<?php
session_start();
// Проверка авторизации админа
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
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
            min-width: 140px;
        }
    </style>
</head>
<body>
    <div class="container admin-container">
        <h1 class="text-center mb-4">Админ-панель — заявки автомобилей</h1>
        <div id="admin-info" class="mb-4 text-end">
            <button class="btn btn-sm btn-secondary" onclick="logoutAdmin()">Выйти из админ-панели</button>
        </div>
        <h5>Всего заявок: <span id="requests-count">0</span></h5>
        <div id="admin-cart-list" class="mt-3">
            <!-- Список выбранных автомобилей -->
        </div>
        <div class="text-end mt-4">
            <a href="home.php" class="btn btn-secondary">Назад на главную</a>
        </div>
    </div>
    <script>
        // Демо-данные автомобилей (тот же массив, что и на главной!)
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

        // Статусы заявок (по умолчанию храним в localStorage отдельно)
        function getRequestsStatuses() {
            const statuses = JSON.parse(localStorage.getItem('requests_statuses') || '{}');
            return statuses;
        }
        function setRequestsStatuses(statuses) {
            localStorage.setItem('requests_statuses', JSON.stringify(statuses));
        }

        function renderAdminCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const container = document.getElementById('admin-cart-list');
            document.getElementById('requests-count').innerText = cart.length;
            if (cart.length === 0) {
                container.innerHTML = '<div class="alert alert-info text-center">Корзина пуста (нет заявок)</div>';
                return;
            }
            let statuses = getRequestsStatuses();
            let html = `<table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Марка/Модель</th>
                        <th>Год</th>
                        <th>Цена</th>
                        <th>Статус авто</th>
                        <th>Описание</th>
                        <th>Статус заявки</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>`;
            cart.forEach(carId => {
                const car = cars.find(c => c.id === carId);
                if (!car) return;
                // состояние заявки
                let reqStatus = statuses[carId] || 'review';
                html += `
                    <tr>
                        <td><img src="${car.images[0]}" alt="${car.brand} ${car.model}" style="width: 80px; border-radius: 8px;"></td>
                        <td>${car.brand} ${car.model}</td>
                        <td>${car.year}</td>
                        <td>${car.price.toLocaleString('ru-RU')} ₽</td>
                        <td>${car.status === 'new' ? "Новый" : "Б/У"}</td>
                        <td>${car.description}</td>
                        <td>
                            <select class="form-select status-select" onchange="updateStatus(${car.id}, this.value)">
                                <option value="review" ${reqStatus==='review'?'selected':''}>В рассмотрении</option>
                                <option value="approved" ${reqStatus==='approved'?'selected':''}>Одобрена</option>
                                <option value="rejected" ${reqStatus==='rejected'?'selected':''}>Отклонено</option>
                            </select>
                        </td>
                        <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${car.id})">Удалить</button></td>
                    </tr>
                `;
            });
            html += '</tbody></table>';
            container.innerHTML = html;
        }

        function updateStatus(carId, newStatus) {
            let statuses = getRequestsStatuses();
            statuses[carId] = newStatus;
            setRequestsStatuses(statuses);
        }

        function removeFromCart(carId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart = cart.filter(id => id !== carId);
            localStorage.setItem('cart', JSON.stringify(cart));
            // очищаем и статус заявки
            let statuses = getRequestsStatuses();
            delete statuses[carId];
            setRequestsStatuses(statuses);
            renderAdminCart();
        }

        function logoutAdmin() {
            if (confirm("Выйти из админ-панели?")) {
                fetch('admin_logout.php').then(() => {
                    window.location.href = 'admin_login.php';
                });
            }
        }

        renderAdminCart();
    </script>
</body>
</html>