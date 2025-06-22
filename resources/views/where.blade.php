@extends('layouts.app')
@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4" style="color: #e63946; font-weight: bold; font-size: 2.5rem;">
                        <i class="bi bi-geo-alt-fill me-2"></i>Где нас найти?
                    </h2>
                    <p class="text-center mb-4" style="color: #222; font-size: 1.25rem; font-weight: 500;">
                        <i class="bi bi-geo"></i> пр-кт Врача Михайлова 13
                    </p>
                    <div class="mb-4 rounded-4 overflow-hidden" style="box-shadow: 0 4px 24px rgba(0,0,0,0.10);">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d37204.70298828723!2d48.53979112211338!3d54.35178670101076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1733822019351!5m2!1sru!2sru" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <h3 class="text-center mb-3" style="color: #e63946; font-weight: bold; font-size: 2rem;">
                        <i class="bi bi-telephone me-2"></i>Хотите заказать пиццу?
                    </h3>
                    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 mb-2">
                        <a href="tel:+79993939" class="btn btn-lg btn-danger shadow-sm px-4 py-2" style="border-radius: 30px; font-size: 1.2rem;">
                            <i class="bi bi-telephone me-2"></i>+7 (773) 123-22-74
                        </a>
                        <a href="mailto:holypizza@mail.ru" class="btn btn-lg btn-outline-danger shadow-sm px-4 py-2" style="border-radius: 30px; font-size: 1.2rem;">
                            <i class="bi bi-envelope me-2"></i>holypizza@mail.ru
                        </a>
                    </div>
                    <div class="text-center mt-4">
                        <span class="badge bg-danger bg-gradient fs-6 p-3 shadow" style="border-radius: 20px;">Работаем ежедневно с 10:00 до 23:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
