<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.app')
@section('content')
    <section class="catalog container pt-4">
    <div class="catalog_text">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <h3 class="about__title mb-0">Сортировать по</h3>
            </div>
            <div class="search-form">
                <form action="{{ route('catalog.search') }}" method="GET" class="d-flex align-items-center">
                    <div class="position-relative">
                        <input type="text" name="search" id="searchInput" class="form-control me-2" placeholder="Поиск товаров..." value="{{ request('search') }}" autocomplete="off">
                        <div id="searchResults" class="search-results"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Поиск
                    </button>
                </form>
            </div>
        </div>
        <div class="catalog__sort">
            <a href="{{ $params->has('filter') ? '?filter=' . $params['filter'] . '&' : '?' }}sort_by{{ $params->has('sort_by') == 'country' ? '_desc' : '' }}=country" class="catalog__sort-item
            {{ (request()->query('sort_by') == 'country' ? 'active' : request()->query('sort_by_desc') == 'country') ? 'active' : '' }}">Вес</a>
            <a href="{{ $params->has('filter') ? '?filter=' . $params['filter'] . '&' : '?' }}sort_by{{ $params->has('sort_by') == 'title' ? '_desc' : '' }}=title" class="catalog__sort-item
            {{ (request()->query('sort_by') == 'title' ? 'active' : request()->query('sort_by_desc') == 'title') ? 'active' : '' }}">Название</a>
            <a href="{{ $params->has('filter') ? '?filter=' . $params['filter'] . '&' : '?' }}sort_by{{ $params->has('sort_by') == 'price' ? '_desc' : '' }}=price" class="catalog__sort-item
            {{ (request()->query('sort_by') == 'price' ? 'active' : request()->query('sort_by_desc') == 'price') ? 'active' : '' }}">Цена</a>
            <a href="/catalog" class="catalog__sort-item--default">Сбросить</a>
        </div>
        </div>
        <div class="catalog__filter">
           @foreach($categories as $category)
               <a href="{{ $params->has('sort_by') ? '?sort_by=' . $params['sort_by'] . '&' : '?' }} filter={{ $category->id }}" class="catalog__filter-item {{ request()->query('filter') == $category->id ? 'active' : '' }}">{{ $category->product_type }}</a>
            @endforeach
        </div>

        @if(count($subcategories) > 0)
        <div class="catalog__filter mt-3">
            <span class="me-2" style="color: #666;">Вид:</span>
            @foreach($subcategories as $subcategory)
                <a href="{{ $params->has('filter') ? '?filter=' . $params['filter'] . '&' : '?' }}subcategory={{ $subcategory->id }}" 
                   class="catalog__filter-item {{ request()->query('subcategory') == $subcategory->id ? 'active' : '' }}">
                    {{ $subcategory->name }}
                </a>
            @endforeach
        </div>
        @endif

        <div class="catalog__list">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="card catalog__item">
                        <img src="{{ Vite::asset('resources/media/images/') . $product->img }}" alt="{{ $product->title }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->price }} руб.</p>
                            <div class="new-product__actions">
                                <a href="/product/{{ $product->id }}" class="btn btn-outline-success">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Ничего не найдено</h3>
            @endif
        </div>
    </section>

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
.toast {
    min-width: 300px;
    background: transparent;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 10px;
    position: relative;
    right: 0;
    opacity: 1 !important;
}

.toast-header {
    border-bottom: none;
    padding: 12px 15px;
    border-radius: 8px 8px 0 0;
}

.toast-body {
    padding: 12px 15px;
    border-radius: 0 0 8px 8px;
}

.btn-close {
    opacity: 0.8;
    padding: 12px;
}

.btn-close:hover {
    opacity: 1;
}

/* Анимация появления */
.toast.showing {
    opacity: 1 !important;
    transform: translateX(0);
    transition: all 0.3s ease;
}

.toast.hide {
    opacity: 0 !important;
    transform: translateX(100%);
    transition: all 0.3s ease;
}

/* Убираем паддинги у контейнера */
.position-fixed {
    padding: 0;
}

/* Обновленные стили для поисковой формы */
.search-form {
    width: 400px;
    display: flex;
    align-items: center;
}

.search-form form {
    margin: 0;
    width: 100%;
}

.search-form .form-control {
    border-radius: 20px 0 0 20px;
    border: 2px solid #e9ecef;
    padding: 6px 12px;
    font-size: 14px;
    transition: all 0.3s ease;
    height: 38px;
    line-height: 1.5;
}

.search-form .form-control:focus {
    border-color: #0d6efd;
    box-shadow: none;
}

.search-form .btn {
    border-radius: 0 20px 20px 0;
    padding: 6px 12px;
    font-size: 14px;
    transition: all 0.3s ease;
    height: 38px;
    line-height: 1.5;
    display: flex;
    align-items: center;
}

.search-form .btn:hover {
    background-color: #0b5ed7;
}

.about__title {
    line-height: 38px;
    margin: 0;
}

@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-form {
        width: 100%;
    }
    
    .about__title {
        text-align: center;
    }
}

/* Стили для результатов поиска */
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
    display: none;
}

.search-results.active {
    display: block;
}

.search-result-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
    transition: background-color 0.2s;
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-item:hover {
    background-color: #f8f9fa;
}

.search-result-item .title {
    font-weight: 500;
    color: #333;
}

.search-result-item .price {
    color: #666;
    font-size: 0.9em;
}

/* Адаптивные стили */
@media (max-width: 1200px) {
    .catalog__list {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

@media (max-width: 992px) {
    .catalog__list {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    .catalog__item {
        margin-bottom: 15px;
    }

    .catalog__sort {
        flex-wrap: wrap;
        gap: 10px;
    }

    .catalog__sort-item {
        margin-right: 10px;
        margin-bottom: 5px;
    }
}

@media (max-width: 768px) {
    .catalog_text {
        padding: 0 15px;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }

    .search-form {
        width: 100%;
    }

    .catalog__filter {
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .catalog__filter-item {
        margin: 5px;
    }

    .catalog__sort {
        justify-content: center;
    }

    .catalog__sort-item {
        margin: 5px;
    }

    .catalog__list {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px;
    }

    .catalog__item {
        margin-bottom: 10px;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card-text {
        font-size: 1rem;
    }

    .new-product__actions {
        flex-direction: row;
        gap: 10px;
    }

    .new-product__actions .btn {
        flex: 1;
        margin: 0;
    }
}

@media (max-width: 576px) {
    .catalog__list {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px;
    }

    .catalog__item {
        max-width: 100%;
    }

    .catalog__sort {
        flex-direction: column;
        align-items: center;
    }

    .catalog__sort-item {
        width: 100%;
        text-align: center;
        margin: 5px 0;
    }

    .catalog__filter {
        flex-direction: column;
        align-items: center;
    }

    .catalog__filter-item {
        width: 100%;
        text-align: center;
        margin: 5px 0;
    }

    .search-form .form-control {
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .search-form .btn {
        border-radius: 20px;
        width: 100%;
    }

    .toast {
        min-width: auto;
        width: 90%;
        left: 50%;
        transform: translateX(-50%);
    }

    .new-product__actions {
        flex-direction: column;
    }

    .new-product__actions .btn {
        width: 100%;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 0.9rem;
    }

    .card-text {
        font-size: 0.8rem;
    }
}

/* Добавляем базовые стили для сетки каталога */
.catalog__list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px 0;
}

.catalog__item {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.catalog__item .card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.catalog__item .new-product__actions {
    margin-top: auto;
    display: flex;
    gap: 10px;
}

.catalog__filter {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
}

.catalog__sort {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`/catalog/live-search?search=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    
                    if (data.length === 0) {
                        searchResults.innerHTML = '<div class="search-result-item">Ничего не найдено</div>';
                    } else {
                        data.forEach(product => {
                            const item = document.createElement('div');
                            item.className = 'search-result-item';
                            item.innerHTML = `
                                <div class="title">${product.title}</div>
                                <div class="price">${product.price} руб.</div>
                            `;
                            item.addEventListener('click', () => {
                                window.location.href = `/product/${product.id}`;
                            });
                            searchResults.appendChild(item);
                        });
                    }
                    
                    searchResults.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }, 300);
    });

    // Закрываем результаты при клике вне поиска
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
});
</script>

<script>
document.querySelectorAll('.catalog__item .btn-outline-success').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('href') + '?modal=1';
        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById('productModalBody').innerHTML = html;
                const modal = new bootstrap.Modal(document.getElementById('productModal'));
                modal.show();
                attachProductModalHandlers();
            });
    });
});

function attachProductModalHandlers() {
    const modalBody = document.getElementById('productModalBody');
    const button = modalBody.querySelector('.product__add-to-cart');
    const sizeBtns = modalBody.querySelectorAll('.size-btn');
    let selectedSize = null;
    if (sizeBtns.length) {
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault();
                sizeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedSize = this.getAttribute('data-size');
                button.disabled = false;
            })
        })
    } else if (button) {
        button.disabled = false;
    }
    if (button) {
        button.addEventListener('click', () => {
            let status = 0;
            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: button.getAttribute('data-id'), size: selectedSize })
            })
            .then(response => status = response.status)
            .then(() => {
                if (status > 300) {
                    const errorToast = modalBody.querySelector('.toast.error');
                    if (errorToast) new bootstrap.Toast(errorToast).show();
                } else {
                    const successToast = modalBody.querySelector('.toast.success');
                    if (successToast) new bootstrap.Toast(successToast).show();
                }
            })
        });
    }
}
</script>

<!-- Модальное окно для продукта -->
<div id="productModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Детали товара</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="productModalBody">
        <!-- Контент продукта будет подгружен сюда -->
      </div>
    </div>
  </div>
</div>

<!-- Стили для затемнения и центрирования -->
<style>
#productModal .modal-content {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0,0,0,0.25);
}
#productModal .modal-body {
    padding: 0;
}
</style>

@endsection
