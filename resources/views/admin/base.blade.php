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
                                <a href="#">Добавить товар</a>
                                <a href="#">Смотреть товары</a>
                                <a href="#">Заказы</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="content col-9">
                <div class="content__wrap text-center wrap-md-pd">
                    @auth
                    <div class="profile-info col-9 d-flex flex-column p-0">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h5>Welcome</h5>
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