@extends('admin.base')

@section('content')
<div class="greeting mt-1 mb-1">
    <div class="col-xxl-4 col-xl-12 mb-4 ">
        <div class="card h-100 card">
            <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-xxl-12">
                        <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                            <h1 class="text-primary h2">Welcome to Admin Panel!</h1>
                            <p class="text-gray-700 mb-0 h4">Here you can update, create and delete products</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="/images/at-work.svg" style="max-width: 26rem"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="admin-info mt-1 mb-1 ">
    <div class="col-xxl-4 col-xl-12 mb-4 ">
        <div class="admin-info__content card">
            <div class="card-body">
                <div class="container">
                    <div class="row w-100 center">
                        <h5 class="text-center h2">Recent activity</h5>
                    </div>
                    <div class="row row-cols-1">
                        <div class="col align-self-start">
                            <div class="text-left alert w-100 alert-warning alert-dismissible fade show h4" role="alert">
                                 You have more than  {{$product_count}} products
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="col">
                            <li class="text-left list-group-item list-group-item h4">
                                You have more than  {{$user_count}} users
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection