@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-header">Редагувати категорію</div>
                    <div class="card-body">
                    <div class="page">
                        <a href="{{ url('/admin/categories') }}" title="назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                                @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/categories/' . $category->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="title" class="control-label">{{ 'Назва категорії товарів' }}</label>
                                <input value="{{$category->maincategory}}" class="form-control" name="maincategory" type="text" >
                                
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" 
                                value="Оновити">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
