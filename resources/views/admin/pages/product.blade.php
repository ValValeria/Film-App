@extends('admin.base')

@section('content')
<div class="container-fluid product">
    <form action="/admin/updateproduct/{{$data->id}}" class="w-100" method="post" enctype="multipart/form-data">
        <div class="wrap-md-pd">
            <div class="brdcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item " aria-current="page">
                            <a href="/admin">Главная</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/admin/products">Продукты</a>
                        </li>
                    </ol>
                </nav>
            </div>
            @if(Auth::user()->can('view',$data))
            <div class="product__actions w-100">
                <div class="container center justify-content-end">
                    <div class="row pt-4 pb-4">
                        <div class="col">
                            <div>
                                <a href="/admin/delete/{{$data->id}}" class="btn btn-danger text-white shadow">Удалить</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="pl-1">
                                <button type="submit" class="btn btn-light shadow">Обновить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="product__title pt-3">
                <h4 class="h2">Описание товара</h4>
            </div>
            @if(session('status'))
            <div class="row pt-2">
                <div class="alert alert-success" role="alert">
                    Ваш пост был обновлён. <a href="/product/{{$data->id}}" class="alert-link">Ссылка на пост</a>
                </div>
            </div>
            @endif
            <div class="product__content">
                <div class="row pt-4">
                    <div class="col">
                        <div class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/{{$data->image}}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col align-self-start text-left">
                        <div class="card ">
                            <div class="card-header">
                                <input type="text" name="title" id="" class="form-control-plaintext text-center" value=" {{$data->title}}">
                            </div>
                            <div class="card-body text-left">
                                <div class="card-title pb-1">
                                    <input type="text" name="short_description" id="" class="form-control-plaintext text-center" value="{{$data->short_description}}">
                                </div>
                                <div class="row ">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">
                                        <strong>Цена</strong>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="number" name="price" class="form-control-plaintext" value="{{$data->price}}">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control-plaintext" value="грн">
                                    </div>
                                </div>
                                <div class="row ">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">
                                        <strong>Вес</strong>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control-plaintext" value="{{$data->weight}}" name="weight">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control-plaintext" value="грамм">
                                    </div>
                                </div>
                                <div class="row pt-3 center">
                                    <div class="col-8 align-self-center">
                                        <a href="/product/{{$data->id}}" class="btn btn-block btn-warning w-100">
                                            Смотреть на сайте
                                        </a>
                                    </div>
                                </div>
                                <div class="row pt-3 center">
                                    <div class="col-8 align-self-center" id="download">
                                        <button class="btn btn-block btn-dark w-100">
                                            Обновить картинку
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col">
                        <div class="product__full-descr card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-sm"> Полное oписание</h5>
                                </div>
                                <div class="product__textarea inner-shadow">
                                    <div>
                                        <textarea class="form-control-plaintext" name="long_description" cols="30" rows="2">
                                        {{$data->long_description}}
                                        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col">
                        <div class="product__full-descr card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-sm"> Состав</h5>
                                </div>
                                <div class="product__textarea inner-shadow">
                                    <div>
                                        <textarea class="form-control-plaintext" name="ingredients" cols="30" rows="2">
                                        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row p-1 pt-2">
                    @if ($errors->any())
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <input type="file" name="image" id="file" hidden>
    </form>
</div>
<script>
    const btn = document.querySelector('#download button');

    btn.onclick = ($event) => {
        $event.preventDefault();
        const file = document.querySelector('#file');
        file.click();

        file.addEventListener("change", () => {
            btn.classList.remove('btn-dark');
            btn.classList.add('btn-light')
        })
    };
</script>
@endsection