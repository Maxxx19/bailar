@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Учасники </div>
                    <div class="card-body">
                    <a href="{{ url('/admin/'.$event) }}" title="назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <form method="GET" action="{{ url('/admin/members') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control smallfield btn-sm" name="search" placeholder="Пошук..." value="{{ request('search') }}">
                                <span class="input-group-append" style="display: inline-block;vertical-align: middle;">
                                    <button class="btn btn-secondary smallfield btn-sm" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th><th>Учасник (ПІБ)</th><th>Вік</th><th>Стать</th><th>Місто</th><th>Клас</th><th>Країна</th><th>Телефон</th><th>Електронна адреса</th><th>Тренер</th><th>Клуб</th><th>Танець</th><th>Вид занять</th><th>Час</th><th>Батько/Мати(ПІБ)</th><th>Батько/Мати(телефон)</th><th>Батько/Мати(електронна адреса)</th>
                                </tr>
                                </thead>
                                @if($members)
                                <tbody class="my-width">
                                @foreach($members as $item)
                                  @if($item->status=='new')
                                    <tr><strong>
                                    <td>{{ $loop->iteration }}</td>
                                        
                                        <td><h4 style="width:200px; overflow: hidden"><strong>{{ $item->name }}</strong></h4></td>
                                        <td><h4 style="width:50px; overflow: hidden"><strong>{{ $item->age }}</strong></h4></td>
                                        <td><h4 style="width:50px; overflow: hidden"><strong>{{ $item->gender }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->city }}</strong></h4></td>
                                        <td><h4 style="width:75px; overflow: hidden"><strong>{{ $item->class }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->country }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->phone }}</strong></h4></td>
                                        <td><h4 style="width:150px; overflow: hidden"><strong>{{ $item->email }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->trainer }}</strong></h4></td>
                                        <td><h4 style="width:75px; overflow: hidden"><strong>{{ $item->club }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->dance }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->kindexercise }}</strong></h4></td>
                                        <td><h4 style="width:120px; overflow: hidden"><strong>{{ $item->time }}</strong></h4></td>
                                        <td><h4 style="width:200px; overflow: hidden"><strong>{{ $item->parentname }}</strong></h4></td>
                                        <td><h4 style="width:100px; overflow: hidden"><strong>{{ $item->parentphone }}</strong></h4></td>
                                        <td><h4 style="width:150px; overflow: hidden"><strong>{{ $item->parentemail }}</strong></h4></td>
                                        <td>
                                        </td>
                                    </strong><tr>
                                  @elseif($item->status!='new')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h4 style="width:200px; overflow: hidden">{{ $item->name }}</h4></td>
                                        <td><h4 style="width:50px; overflow: hidden">{{ $item->age }}</h4></td>
                                        <td><h4 style="width:50px; overflow: hidden">{{ $item->gender }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->city }}</h4></td>
                                        <td><h4 style="width:75px; overflow: hidden">{{ $item->class }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->country }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->phone }}</h4></td>
                                        <td><h4 style="width:150px; overflow: hidden">{{ $item->email }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->trainer }}</h4></td>
                                        <td><h4 style="width:75px; overflow: hidden">{{ $item->club }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->dance }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->kindexercise }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->time }}</h4></td>
                                        <td><h4 style="width:200px; overflow: hidden">{{ $item->parentname }}</h4></td>
                                        <td><h4 style="width:100px; overflow: hidden">{{ $item->parentphone }}</h4></td>
                                        <td><h4 style="width:150px; overflow: hidden">{{ $item->parentemail }}</h4></td>
                                        <td>
                                        </td>
                                       </tr> 
                                    @endif
                                @endforeach
                                </tbody>
                                @endif
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


