@extends('admin.base')

@section('content')
<div class="container">
    <div class="wrap-md-pd">
        <h4 class="text-center headline">Ваши товары</h4>
        <div class="card-container">
        @foreach ($data as $product)
            <div class="card">
                <img src="{{$product->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{$product->short_description}}</p>
                    <a href="/product/{{$product->id}}" class="btn btn-primary">Подробнее</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

{{ $data->links() }}
@endsection