<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPizza</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="nav__area col-3">
                <nav class="navbar navbar-dark bg-dark d-flex align-items-start">
                    <div class="container-fluid wrap-md-pd">
                        <div class="row row-cols-1 justify-content-md-center text-center">
                            <div class="col-sm">
                                <span class="navbar-brand mb-0 h1 ">MyPizza</span>
                            </div>
                            <div class="nav__links col d-flex justify-content-start flex-column text-left">
                                <a href="/admin"> Главная</a>
                                <a href="/admin/addproduct">Добавить товар</a>
                                <a href="/admin/users">Пользователи</a>
                                <a href="/admin/products">Смотреть товары</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="content col-9">
                @auth
                <div class="profile-info  d-flex flex-column p-0 w-100">
                    <ul class="list-group w-100 center">
                        <li class="list-group-item d-flex justify-content-between w-100 center">
                            <div class="wrap-md center">
                                <h5 class="h3 w-100 p-1 text-left mb-0">Welcome, {{Auth::user()->username}}</h5>
                            </div>
                        </li>
                    </ul>
                </div>
                @endauth
                <div class="content__wrap text-center wrap-md-pd">
                    <div class="content__items">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>