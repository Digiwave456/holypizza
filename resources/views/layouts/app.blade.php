<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
        <div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    <footer class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%;">
        <div class="container footer-container">
            <div class="footer-section">
                
                <h4>О нас</h4>
                <p>HolyPizza - лучшая пицца в Ульяновске! Мы готовим пиццу с любовью и используем только свежие ингредиенты.</p>
            </div>
            
            <div class="footer-section">
                <h4>Контакты</h4>
                <p><i class="fas fa-map-marker-alt"></i> пр-т Созидателей 13</p>
                <p><i class="fas fa-phone"></i> +7 (8222) 45 65 67</p>
                <p><i class="fas fa-envelope"></i> holypizza@gmail.com</p>
                <p><i class="fas fa-clock"></i> Ежедневно с 10:00 до 23:00</p>
            </div>

            <div class="footer-section">
                <h4>Наши соцсети</h4>
                <div class="social-links">
                    <a href="#" title="ВКонтакте"><i class="fab fa-vk"></i></a>
                    <a href="#" title="Telegram"><i class="fab fa-telegram"></i></a>
                </div>
                <p>@holypizza</p>
            </div>

            <div class="footer-section">
                <h4>Полезные ссылки</h4>
                <p><a href="/catalog" style="color: #cccccc; text-decoration: none;">Каталог</a></p>
                <p><a href="/cart" style="color: #cccccc; text-decoration: none;">Корзина</a></p>
                <p><a href="/delivery" style="color: #cccccc; text-decoration: none;">Доставка</a></p>
                <p><a href="/about" style="color: #cccccc; text-decoration: none;">О нас</a></p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} HolyPizza. Все права защищены.</p>
        </div>
    </footer>
</html>
