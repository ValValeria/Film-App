@extends('admin.base')

@section('content')
<div class="section container">
    <div class="wrap-md-pd">
        <h4 class="section__title text-center h2">Ваши письма</h4>

        @if(count($letters))
        <div class="text-right w-100">
            <a href="/admin/delete-letters" type="button" class="btn btn-danger text-white">
                Удалить все письма
            </a>
        </div>
        @endif

        @if(session('status'))
        <div class="row pt-2 w-100">
            <div class="alert alert-success w-100" role="alert">
                Письмо было удолено
            </div>
        </div>
        @endif

        @if(!count($letters))
        <div class="card mt-2">
            <div class="card-body">
                <div class="center flex-column">
                    <div class="h3">
                        У вас нет жалоб
                    </div>
                    <div>
                        <img src="/images/boom.webp" class="card-img" alt="..." style="max-width:400px;">
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="card-container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Имейл</th>
                        <th scope="col">Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($letters as $key=>$letter)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>
                            <a href="/admin/letter/{{$letter->id}}">
                                {{$letter->username}}
                            </a>
                        </td>
                        <td>
                            {{$letter->email}}
                        </td>
                        <td>
                            {{$letter->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-100 center pt-2">
            {{ $letters->links() }}
        </div>
        @endif

    </div>
</div>
@endsection