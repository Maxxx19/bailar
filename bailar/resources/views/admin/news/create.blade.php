@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 105%;">
                    <div class="card-header">Додати нову новину</div>
                    <div class="card-body">
                    <div class="page">
                        <a href="{{ url('/admin/news') }}" title="назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <div class="container">
                        <div id="output" class="row containerImg"></div>
                        <br/>
                        <h2>Завантажити фотографію</h2>
                        <input type="file" name="image" class="image btn btn-sm" title="Завантажити фото">
                        @include('admin.cropper')
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ url('/admin/news') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('admin.news.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
