@extends('admin.base')

@section('content')
<div class="section container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Ваши товары</h4>

        <div class="center flex-column w-100">
            @if(count($data))
            <div class="card w-100">
                <form class="card-body center flex-row" method="GET">
                    <div class="col-auto" style="flex: 1 1 80%;">
                        <input type="text" name="search" class="form-control w-100" id="inputPassword2" value="{{old('search')}}">
                    </div>
                    <div class="col-auto" style="flex: 1 1 20%;">
                        <button type="submit" class="btn btn-dark w-100">Найти</button>
                    </div>
                </form>
            </div>
            <div class="card w-100 card-section">
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Вес</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key=>$product)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>
                                    <a href="/admin/product/{{$product->id}}">
                                        {{$product->title}}
                                    </a>
                                </td>
                                <td>
                                    {{$product->price}}
                                </td>

                                <td>
                                    {{$product->weight}}
                                </td>
                                <td>
                                    <div style="height:50px;width:50px;border-radius:50%;">
                                        <img src="/{{$product->image}}" alt="..." style="object-fit:cover;width:100%;">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="card mt-2">
                <div class="card-body">
                    <div class="center flex-column">
                        <div class="h3">
                            У вас нет товаров
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

<div class="center w-100">
    {{ $data->links() }}
</div>
@endsection