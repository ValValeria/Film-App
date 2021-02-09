@extends('admin.base')

@section('content')
<div class="section container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Пользователи</h4>
        @if(count($users))
        <div class="text-right w-100">
            @if(!isset($_GET['onlyusers']))
            <a href="/admin/users/?onlyusers=true" type="button" class="btn btn-light">
                Показать пользователей с заказами
            </a>
            @else
            <a href="/admin/users/" type="button" class="btn btn-light">
                Показать всех пользователей
            </a>
            @endif
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
                    @foreach($users as $key=>$user)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>
                            <a href="/admin/user/{{$user->id}}">
                                {{$user->username}}
                            </a>
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
        <div class="w-100 center">
            {{ $users->links() }}
        </div>
        @else
        <div class="card mt-2">
            <div class="card-body">
                <div class="center flex-column">
                    <div class="h3">
                        У вас нет пользователей
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
@endsection