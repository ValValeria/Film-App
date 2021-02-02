@extends('admin.base')

@section('content')
<div class="section container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Ваши заказы</h4>

        <div class="center flex-column">
            <div class="card w-100 card-section">
                <div class="card-body">
                    <h1 class="h3 text-center">
                        Неактивные заказы
                    </h1>
                    <h4 class="h4 text-center p-4">
                        <a href="/admin/orders">Посмотреть активные заказы. У вас их {{$count}}</a>
                    </h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
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
                                    <a href="/admin/user/{{$order->user->id}}">
                                        {{$order->user->username}}
                                    </a>
                                </td>
                                <!--   <td>
                                    <a href="/admin/change-order-status/{{$order->id}}" class="btn btn-dark p text-white">
                                        Пом-ть статус
                                    </a>
                                </td>-->
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