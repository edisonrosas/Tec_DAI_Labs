@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="d-md-inline-flex">
            @auth <!--Comprobar el logeo del usuario -->
                <!-- Si está logeado cargaran los siguientes botones-->
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="location.href='{{ url('/posts/myposts')}}'">
                        {{__('auth.My Posts')}}
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" onclick="location.href='{{ url('/posts/create')}}'">
                        {{__('auth.Create Post')}}
                    </button>
                </div>
            @else 
            @endauth
            <div class="col-auto">
                <button class="btn btn-outline-primary" onclick="location.href='{{ url('/today')}}'">
                    {{__('auth.Today Posts')}}
                </button>
            </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Post</th>
                <th scope="col">Usuario</th>
                <th scope="col">Comentario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notificaciones as $notificacion)
                <tr>
                    <th> {{$notificacion->created_at}}</th>
                    <th> {{$notificacion->data['title'] }}</th>    
                    <th> {{$notificacion->data['user'] }}</th>  
                    <th> {{$notificacion->data['comment'] }}</th>  
                </tr>
                @php
                    $notificacion->markAsRead();
                @endphp
            @endforeach
        </tbody>
    </table>

</div>
@endsection
