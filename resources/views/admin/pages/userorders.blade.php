@extends('admin.base')

@section('content')
<div class="section container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Пользователь</h4>
        <div class="text-right w-100 card-section">
            <div class="card">
                <div class="card-body">
                    <div class="w-100">
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label h4">Имейл</label>
                            <div class="col-sm-10">
                                <input type="email" readonly value="{{$user->email}}" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label h4">Имя</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$user->username}}" id="inputPassword3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label h4">Пароль</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$user->password}}" id="inputPassword3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user__analise card-section">
            <div class="card">
                <div class="card-title h3 center">
                    Информация о пользователе
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            За всё время пользователь заказал
                            <span class="badge bg-primary rounded-pill text-white">
                                {{$user->orders()->count()}}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="center flex-column">
            <div class="card w-100 card-section">
                <div class="card-body">
                    <h1 class="h3 text-center">
                        Активные заказы
                    </h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders()->where('status','active')->get() as $order)
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <a href="/admin/product/{{$order->product->id}}">
                                        {{$order->product->title}}
                                    </a>
                                </td>
                                <td>
                                    {{$order->quantity}}
                                </td>

                                <td>
                                    {{$order->created_at}}
                                </td>
                                <td>
                                    <a href="/admin/change-order-status/{{$order->id}}" class="btn btn-dark text-white">
                                        Пом-ть статус
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="center flex-column">
            <div class="card w-100 card-section">
                <div class="card-body">
                    <h1 class="h3 text-center">
                        Неактивные заказы
                    </h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders()->where('status','unactive')->get() as $order)
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <a href="/admin/product/{{$order->product->id}}">
                                        {{$order->product->title}}
                                    </a>
                                </td>
                                <td>
                                    {{$order->quantity}}
                                </td>
                                <td>
                                    {{$order->created_at}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection