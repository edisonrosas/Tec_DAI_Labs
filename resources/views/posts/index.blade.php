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
    @foreach($posts as $post)
    <div class="row align-items-center h-100">
        <div class="card col-md-8 mx-auto">
            <div class="card-body">
                <h5 class="card title">
                    <a href="{{ url('/posts/'. $post->id) }}">
                        {{$post->title}}
                    </a>
                </h5>
            </div>
        </div>
    </div>
    @endforeach
    {{--
    <div class=" pagination-lg">
        Página {{$posts->currentPage()}} de {{$posts->lastPage()}} 
    </div>
    <div class="col-auto">
        <a  class=" btn btn-secondary" href="{{$posts->previousPageUrl()}}" > Anterior</a>
        <a class=" btn btn-secondary" href="{{$posts->nextPageUrl()}}" > Siguiente</a>
    </div>
--}}
</div>
@endsection
