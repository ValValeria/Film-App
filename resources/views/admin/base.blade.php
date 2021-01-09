<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/admin.css">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
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
                                <a href="/admin/products">Смотреть товары</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="content col-9">
                <div class="content__wrap text-center wrap-md-pd">
                    @auth
                    <div class="profile-info  d-flex flex-column p-0 w-100">
                        <ul class="list-group w-100">
                            <li class="list-group-item d-flex justify-content-between w-100">
                                <h5 class="font-upper w-100">Welcome, {{Auth::user()->username}}</h5>
                            </li>
                        </ul>
                    </div>
                    @endauth
                    <div class="content__items">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>