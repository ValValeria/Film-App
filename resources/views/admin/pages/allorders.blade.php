@extends('admin.base')

@section('content')
<div class="container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Ваши заказы</h4>

        <div class="center flex-column">
            @if(count($orders))
            <div class="card w-100 card-section">
                <div class="card-body">
                    <h1 class="h3 text-center">
                        Активные заказы
                    </h1>
                    <h4 class="h4 text-center p-4">
                        <a href="/admin/unactive-orders">Посмотреть неактивные заказы. У вас их {{$count}}</a>
                    </h4>
                    @if(session('status'))
                    <div class="pt-2 pb-2 center w-100">
                        <div class="alert alert-success shadow w-100">Вы успешно обновили {{session('count_update')}} заказ/ов</div>
                    </div>
                    @endif
                    <form method="post" action="/admin/change-order-status">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">
                                        Пользователь
                                    </th>
                                    <th>
                                        Место
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th scope="row center">
                                        <div class="form-check center">
                                            <input class="form-check-input" type="checkbox" value="{{$order->id}}" name="orders_id[]" style="transform:scale(1.5)">
                                        </div>
                                    </th>
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
                                        <a href="/admin/user/{{$order->user->id}}">
                                            {{$order->user->username}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$order->location}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="w-100 center align-item-end">
                            <button class="btn btn-danger font-white">
                                Изменить статус
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="card mt-2">
                <div class="card-body">
                    <div class="center flex-column">
                        <div class="h3">
                            У вас нет заказов
                        </div>
                        <div>
                            <img src="/images/boom.webp" class="card-img" alt="..." style="max-width:400px;">
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection