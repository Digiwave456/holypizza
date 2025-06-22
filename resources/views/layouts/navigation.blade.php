<nav class="navbar navbar-expand-lg bg-white navbar-light shadow">
    <div class="container-fluid container">
        <a class="navbar-brand" href="/">
            <img src="{{ Vite::asset('resources/media/images/logo.png') }}" alt="Logo" style="height: 100px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog') }}">Меню</a>
                </li>
                
               
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('where') }}">Контакты</a>
                </li>
            </ul>
            @guest
                <div class="d-flex gap-3">
                    <a class="nav-link btn-sm" href="{{ route('register') }}">Зарегистрируйтесь</a>
                    <b class="text-dark align-self-center">/</b>
                    <a class="nav-link btn-sm" href="{{ route('login') }}">Войдите</a>
                </div>
            @endguest
            @auth
    <div class="d-flex gap-3">
        @if(auth()->user()->isAdmin())
            {{-- Ссылки для администратора --}}
            <a class="nav-link btn-sm {{ Request::is('admin/orders') ? 'active' : '' }}" 
               href="{{ route('admin.orders') }}">
               Панель управления
            </a>
            
        @endif
        
        {{-- Общие ссылки --}}
        <a class="nav-link btn-sm {{ Request::is('user') ? 'active' : '' }}" 
           href="{{ route('user') }}">
           Профиль
        </a>
        <a class="nav-link btn-sm {{ Request::is('cart') ? 'active' : '' }}" 
           href="{{ route('cart') }}">
           Корзина
        </a>
        
        
    </div>
@endauth
        </div>
    </div>
</nav>
