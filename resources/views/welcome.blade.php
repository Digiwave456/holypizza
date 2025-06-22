<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HolyPizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
@extends('Layouts.app')
@section('content')

<!-- Баннер акции -->
<div class="carousel-container">
    <div class="carousel">
        <div class="carousel-item active">
        <img src="/images/bannerio.png" 
                              
                             class="new-product__image">
        </div>
        <div class="carousel-item">
        <img src="/images/banner2.jpg" 
                            
                             class="new-product__image">
        </div>
        <div class="carousel-item">
        <img src="/images/banner3.jpg"  
                             
                             class="new-product__image">
        </div>
    </div>
    
    <button class="carousel-btn prev">❮</button>
    <button class="carousel-btn next">❯</button>
    
    <div class="indicators"></div>
</div>

<!-- Новинки -->
<section class="new-products">
        <div class="container">
        <h3 style="text-align: center; color: red; font-weight: bold; font-size: 80px;">Новинки</h3>
            <div class="new-products__grid">
                @foreach($newProducts as $product)
                <div class="new-product__card">
                    <div class="new-product__image-container">
                        <img src="/images/{{ $product->img }}" 
                             alt="{{ $product->title }}" 
                             class="new-product__image">
                        <div class="new-product__badge">HOT!</div>
                    </div>
                    <div class="new-product__info">
                        <h4 class="new-product__title">{{ $product->title }}</h4>
                        <p class="new-product__price">{{ $product->price }} ₽</p>
                        <div class="new-product__actions">
                            <a href="/product/{{ $product->id }}" class="btn btn-outline-success">Подробнее</a>
                            @auth
                                <button onclick="addToCart({{ $product->id }})" class="btn cart-red-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
<div class="delivery-block">
    <div class="delivery-header">
        <h2 class="delivery-title">🚚 Доставка и оплата в Ульяновске</h2>
        <div class="decorative-line"></div>
    </div>

    <div class="guarantee-card pulse">
        <div class="icon-wrapper">⏱</div>
        <div class="guarantee-content">
            <span class="guarantee-text">30 МИНУТ ИЛИ СКИДКА 20%</span>
            <p class="guarantee-description">При нарушении сроков доставки вы получаете скидку 20% на текущий заказ</p>
        </div>
    </div>

   

    <div class="price-container">
        <div class="price-card neon">
            <div class="price-item">
                <div class="icon">💰</div>
                <span class="highlight-sum">От 890 ₽</span>
                <p>Минимальный заказ</p>
            </div>
            <div class="price-item">
                <div class="icon">💳</div>
                <span class="highlight-sum">Принимаем карты,СБП</span>
                
            </div>
        </div>
    </div>



    <div class="delivery-zones">
        <h3>🌍 Зона покрытия</h3>
        <div class="zone-map">
            <div class="zone-item hover-effect">
                <div class="pin">📍</div>
                <div class="zone-info">
                    <h4>Левый берег</h4>
                    <p>Нижняя терраса,Верхняя терраса,Новый город</p>
                </div>
            </div>
            <div class="zone-item hover-effect">
                <div class="pin">📍</div>
                <div class="zone-info">
                    <h4>Правый берег</h4>
                    <p>Ж/Д район,Засвияжье</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Форма обратной связи -->
<section class="feedback-section">
    <div class="container">
        <h3 style="text-align: center; color: red; font-weight: bold; font-size: 80px;">Обратная связь</h3>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="feedback-form" method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Имя" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Эл.почта" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Сообщение" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</section>

<!-- Существующие скрипты и стили для тостов -->
@auth
<div class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Успешно</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-success text-white">
            Товар успешно добавлен в корзину
        </div>
    </div>
    
    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong class="me-auto">Ошибка</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-danger text-white">
            Товара нет в наличии
        </div>
    </div>
</div>

<script>
function addToCart(productId) {
    fetch(`/add-to-cart/${productId}`)
        .then(response => {
            if (response.ok) {
                const toast = new bootstrap.Toast(document.getElementById('successToast'), {
                    autohide: true,
                    delay: 3000
                });
                toast.show();
            } else {
                const toast = new bootstrap.Toast(document.getElementById('errorToast'), {
                    autohide: true,
                    delay: 3000
                });
                toast.show();
            }
        })
        .catch(() => {
            const toast = new bootstrap.Toast(document.getElementById('errorToast'), {
                autohide: true,
                delay: 3000
            });
            toast.show();
        });
}
</script>
@endauth

<style>
.cart-red-btn {
    background: #FF0000 !important;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    transition: background 0.3s;
}
.cart-red-btn:hover {
    background: #d10000 !important;
}
.cart-red-btn .fa-shopping-cart {
    color: #fff !important;
    font-size: 20px;
}
</style>

@endsection
</body>
</html>
