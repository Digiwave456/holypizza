@extends('layouts.admin')
@section('content')
    <div class="product-edit">
    <div class="container">
        <form action="/product-create" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Количество</label>
                <input type="number" class="form-control" id="qty" name="qty">
            </div>
            <div class="mb-3">
    <label for="color" class="form-label">Подача</label>
    <select class="form-select" id="color" name="color">
        <option value="hot">Горячая</option>
        <option value="cold">Холодная</option>
    </select>
</div>
            <div class="mb-3">
                <label for="img" class="form-label">Изображение</label>
                <input type="text" class="form-control" id="img" name="img"
                       placeholder="Введите название изображения с расширением файла из resource/media/images">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Вес</label>
                <input type="text" class="form-control" id="country" name="country">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->product_type }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="Подтвердить">
        </form>
    </div>
</div>
@endsection
