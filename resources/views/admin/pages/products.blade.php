@extends('admin.base')

@section('content')
<div class="container">
    <div class="wrap-md-pd">
        <h4 class="text-center h2">Ваши товары</h4>
        <div class="card-container">
        @foreach ($data as $product)
            <div class="card center flex-column shadow">
                <img src="/{{$product->image}}" 
                class="card-img-top"
                alt="..."
                style="max-width:280px;"
                >
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{$product->short_description}}</p>
                    <a href="/admin/product/{{$product->id}}" class="btn text-white btn-dark">Подробнее</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

{{ $data->links() }}
@endsection