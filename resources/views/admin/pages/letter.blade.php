@extends('admin.base')

@section('content')
<div class="container-fluid letter">
    <div class="wrap-md-pd">
        <div class="brdcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="/admin">Главная</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="/admin/letters">Письма</a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="letter__actions w-100">
            <div class="container center justify-content-end">
                <div class="row pt-4 pb-4">
                    <div class="col">
                        <div>
                            <a href="/admin/delete-letter/{{$letter->id}}" class="btn btn-danger text-white shadow">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="letter__title pt-3">
            <h4 class="section__title h2">Содержание письма</h4>
        </div>
        <div class="letter__content">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="input-group">
                        <span class="input-group-text" style="display: inline-block;
    width: 210px;">Имейл пользователя</span>
                        <input type="text" value="{{$letter->email}}" aria-label="First name" class="form-control">
                    </div>
                    <div class="input-group mt-2">
                        <span class="input-group-text" style="display: inline-block;
    width: 210px;">Имя пользователя</span>
                        <input type="text" value="{{$letter->username}}" aria-label="First name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="h3 mb-2">Письмо</h3>
                    <div class="card-text p-2" style="font-style: italic;">
                        {{$letter->message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection