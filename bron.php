<!-- <!DOCTYPE html>
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
 -->

 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки автомобилей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: rgba(204, 0, 0, 0.1);
        }
        .catalog-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            margin: 30px auto;
            max-width: 1200px;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .carousel-inner img {
            max-height: 180px;
            object-fit: cover;
        }
        .btn-cart {
            background-color: #D32F2F;
            color: #fff;
            border: none;
        }
        .btn-cart:hover {
            background-color: #C2185B;
        }
        .filter-section {
            margin-bottom: 30px;
        }
        .badge {
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container catalog-container">
        <h1 class="text-center mb-4">Заявки автомобилей</h1>
        <div class="filter-section row g-3">
            <div class="col-md-2">
                <select class="form-select" id="filter-brand">
                    <option value="">Марка</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Hyundai">Hyundai</option>
                    <option value="BMW">BMW</option>
                    <option value="Kia">Kia</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filter-model">
                    <option value="">Модель</option>
                    <option value="Camry">Camry</option>
                    <option value="Solaris">Solaris</option>
                    <option value="X5">X5</option>
                    <option value="Rio">Rio</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filter-year">
                    <option value="">Год</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filter-price">
                    <option value="">Цена</option>
                    <option value="low">до 1 000 000</option>
                    <option value="medium">1 000 000 - 2 000 000</option>
                    <option value="high">свыше 2 000 000</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="filter-status">
                    <option value="">Статус</option>
                    <option value="new">Новый</option>
                    <option value="used">Б/У</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100" id="reset-filters">Сбросить</button>
            </div>
        </div>
        <div class="row" id="cars-list">
            <!-- Карточки автомобилей будут подгружаться здесь -->
        </div>
        <div class="text-end mt-4">
            <a href="admin.php" class="btn btn-dark">Перейти в админ-панель</a>
        </div>
    </div>

    <script>
        // Демо-данные автомобилей
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

        // Отрисовка карточек автомобилей
        function renderCars(filter = {}) {
            const carList = document.getElementById('cars-list');
            carList.innerHTML = '';

            let filteredCars = cars.filter(car => {
                return (!filter.brand || car.brand === filter.brand)
                    && (!filter.model || car.model === filter.model)
                    && (!filter.year || car.year == filter.year)
                    && (!filter.price || (
                        filter.price === 'low' && car.price < 1000000 ||
                        filter.price === 'medium' && car.price >= 1000000 && car.price <= 2000000 ||
                        filter.price === 'high' && car.price > 2000000
                    ))
                    && (!filter.status || car.status === filter.status);
            });

            if (filteredCars.length === 0) {
                carList.innerHTML = '<div class="col-12 text-center text-muted mt-5">Нет подходящих автомобилей</div>';
                return;
            }

            filteredCars.forEach(car => {
                const imagesCarouselId = `carousel${car.id}`;
                const card = document.createElement('div');
                card.className = 'col-md-6 col-lg-4 mb-4';
                card.innerHTML = `
                    <div class="card h-100">
                        <div id="${imagesCarouselId}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                ${car.images.map((img, idx) => `
                                    <div class="carousel-item${idx === 0 ? ' active' : ''}">
                                        <img src="${img}" class="d-block w-100" alt="${car.brand} ${car.model}">
                                    </div>
                                `).join('')}
                            </div>
                            ${car.images.length > 1 ? `
                                <button class="carousel-control-prev" type="button" data-bs-target="#${imagesCarouselId}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#${imagesCarouselId}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            ` : ''}
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">${car.brand} ${car.model}</h5>
                            <span class="badge bg-primary mb-2">${car.year}</span>
                            <span class="badge bg-warning text-dark mb-2">${car.status === 'new' ? 'Новый' : 'Б/У'}</span>
                            <p class="card-text">${car.description}</p>
                            <h6 class="mt-auto mb-3">Цена: ${car.price.toLocaleString('ru-RU')} ₽</h6>
                            <button class="btn btn-cart w-100" onclick="addToCart(${car.id})">Добавить в корзину</button>
                        </div>
                    </div>
                `;
                carList.appendChild(card);
            });
        }

        // Добавление в "корзину" (передача в localStorage)
        function addToCart(carId) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (!cart.includes(carId)) {
                cart.push(carId);
                localStorage.setItem('cart', JSON.stringify(cart));
                alert('Автомобиль добавлен в корзину для админ-панели!');
            } else {
                alert('Этот автомобиль уже в корзине.');
            }
        }

        // Фильтрация
        function getFilters() {
            return {
                brand: document.getElementById('filter-brand').value,
                model: document.getElementById('filter-model').value,
                year: document.getElementById('filter-year').value,
                price: document.getElementById('filter-price').value,
                status: document.getElementById('filter-status').value
            };
        }

        document.querySelectorAll('.filter-section select').forEach(sel => {
            sel.addEventListener('change', () => {
                renderCars(getFilters());
            });
        });

        document.getElementById('reset-filters').addEventListener('click', () => {
            document.querySelectorAll('.filter-section select').forEach(sel => sel.value = '');
            renderCars();
        });

        // Первая отрисовка
        renderCars();
    </script>
</body>
</html>