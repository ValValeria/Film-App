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
    <div class='login__wrap center'>
        <div class="login__form-area shadow ">
            <h5 class="login__title headline">Войти</h5>
            @if(!Auth::check())
            <div class="pt-2">
                <form class="login__form wrap-md" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Имейл </label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="{{ old('password') }}">
                    </div>
                    <div class="w-100 center mb-3">
                        <button type="submit" class="btn btn-dark">Отправить</button>
                    </div>
                    @if ($errors->any())
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                        <li class="list-group-item warn">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </form>
            </div>
            @else
            <div class="login__success">
                <ul class="list-group">
                    <li class="list-group-item">
                        Вы успешно вошли в систему
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection