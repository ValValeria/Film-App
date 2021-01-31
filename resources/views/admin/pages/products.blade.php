@extends('admin.base')

@section('content')
<div class="container">
    <div class="wrap-md-pd">
        <h4 class="text-center h2">Ваши товары</h4>

        <div class="center flex-column">
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
        </div>

    </div>
</div>

<div class="center w-100">
    {{ $data->links() }}
</div>
@endsection