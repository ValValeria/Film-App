@extends('admin.base')

@section('content')
<div class="product container-fluid">
    <div class="wrap-md-pd">
        <h5 class="text-center">Добавить новый товар</h5>
    </div>
    <div class="product__form">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="tile" class="col-sm-2 col-form-label">Заголовок</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Короткое описание</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="short_description">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Полное описание</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="long_description"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Загрузить изображение</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="" class="form-control" name="image">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Цена</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="price">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Масса</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="weight">
                </div>
            </div>
            <div class="row center">
                <button type="submit" class="btn btn-primary mb-3 col-sm-2">Отправить</button>
            </div>
            <div class="row">
                 @if ($errors->any())
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item warn">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            @if(session('status'))
            <ul class="list-group w-100">
                <li class="list-group-item d-flex justify-content-between w-100">
                    <h5 class=" w-100">Добавлено</h5>
                </li>
            </ul>
            @endif
        </form>
    </div>
</div>
@endsection