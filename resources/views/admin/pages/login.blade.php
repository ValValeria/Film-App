@extends('admin.base')

@section('content')
<div class="bread-crumps">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
            <li class="breadcrumb-item actine"><a href="/admin/login" aria-current="page">Вход в систему</a></li>
        </ol>
    </nav>
</div>
<div class="login container">
    <div class='login__wrap'>
        <h5 class="login__title">Войти</h5>
        @if(!Auth::check())
        <div class="pt-2">
            <form class="login__form wrap-md" method="POST" action="/admin/login">
                <div class="mb-3">
                    <label for="exampleInputEmail1" name="email" class="form-label">Имейл </label>
                    <input type="email"
                    class="form-control"
                    id="exampleInputEmail1" 
                    aria-describedby="emailHelp"
                    value="{{ old('email') }}"
                    >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" name="password" class="form-label">Пароль</label>
                    <input type="password"
                     class="form-control" 
                     id="exampleInputPassword1"
                     value="{{ old('password') }}">
                </div>
                <div class="w-100 center mb-3">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
                @if ($errors->any())
                <div class="mt-3">
                    <ul class="list-group">
                        @error('email')
                        <li class="list-group-item list-group-item-danger">Неправильный имейл</li>
                        @enderror

                        @error('password')
                        <li class="list-group-item list-group-item-danger">Некорректный пароль</li>
                        @enderror
                        <li class="list-group-item list-group-item-danger">Проверьте правильность ваших данных</li>
                    </ul>
                </div>
                @endif
            </form>
        </div>
        @else
        <div class="login__success">
             <ul class="list-group">
                 <li class="list-group-item">
                     Вы уже зарегестрированы
                 </li>
             </ul>
        </div>
        @endif
    </div>
</div>
@endsection