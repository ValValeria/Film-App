@extends('admin.base')

@section('content')
<div class="container">
    <div class="wrap-md-pd">
        <h4 class="text-center h2">Пользователи</h4>
        <div class="text-right w-100">
            <a href="/admin/users/?onlyusers=true" type="button" class="btn btn-light">
                Показать пользователей с заказами
            </a>
        </div>
        <div class="card-container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Имейл</th>
                        <th scope="col">Кол-ство заказов</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            {{$user->username}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->orders()->count()}}
                        </td>
                        <td>
                            <button class="btn btn-danger text-white">
                                Удалить
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection