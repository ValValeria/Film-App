@extends('admin.base')

@section('content')
<div class="container-fluid product">
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
        <div class="product__actions w-100">
              <div class="container center justify-content-end">
                    <div class="pt-4 pb-4">
                        <a href="/delete/{{$data->id}}" class="btn btn-danger">Удалить</a>
                    </div>
              </div>
        </div>
        <div class="product__title pt-3">
            <h4>{{$data->title}}</h4>
        </div>
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
                <div class="col align-self-center">
                    <div class="card">
                        <div class="card-body">
                            {{$data->short_description}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col">
                    <div class="accordition">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Полное описание
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                   {{$data->long_description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection