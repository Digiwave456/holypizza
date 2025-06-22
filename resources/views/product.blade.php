@extends('layouts.app')

@section('content')
    <div class="product">
        <div class="container">
        <a href="/product/{{ $product->id }}">
            <img src="{{ Vite::asset('resources/media/images/') . $product->img }}" alt="" class="product__image">
            <div class="product__main-info">
                <div class="product__title">{{ $product->title }}</div>
                <div class="product__price">{{ $product->price }} руб.</div>
                @auth
                    @if($product->product_type === 'Пицца')
                        <div class="product__sizes d-flex justify-content-center mb-3">
                            <button class="btn btn-outline-danger mx-1 size-btn" data-size="25">25 см</button>
                            <button class="btn btn-outline-danger mx-1 size-btn" data-size="30">30 см</button>
                            <button class="btn btn-outline-danger mx-1 size-btn" data-size="35">35 см</button>
                        </div>
                    @endif
                    <div class="d-flex">
                        <button class="product__add-to-cart" disabled>Добавить в корзину</button>
                        <div class="toast error align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">В наличии столько нет</div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="toast success align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">Товар добавлен в корзину</div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </a>

        <div class="product__description">
            <!-- Отображаем описание продукта -->
            <h4>Cостав:</h4>
            <p>{{ $product->description ?? 'Описание отсутствует' }}</p>
        </div>

        <div class="product__characteristic">
            <table>
                <tr>
                    <td>Категория</td>
                    <td>{{ $product->product_type }}</td>
                </tr>
                <tr>
                    <td>Вес</td>
                    <td>{{ $product->country }}</td>
                </tr>
                <tr>
                    <td>Подача</td>
                    <td>{{ $product->color }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

    <script>
        const pid = {{ $product->id }}
        let selectedSize = null;
        const button = document.querySelector('.product__add-to-cart')
        const sizeBtns = document.querySelectorAll('.size-btn')
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
        } else {
            button.disabled = false;
        }
        button.addEventListener('click', () => {
            let status = 0
            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: pid, size: selectedSize })
            })
            .then(response => status = response.status)
            .then(() => {
                if (status > 300) {
                    const errorToast = new bootstrap.Toast(document.querySelector('.toast.error'))
                    errorToast.show()
                } else {
                    const succesToast = new bootstrap.Toast(document.querySelector('.toast.success'))
                    succesToast.show()
                }
            })
        })
    </script>
@endsection
