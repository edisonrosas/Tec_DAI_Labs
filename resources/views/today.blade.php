@extends('layouts.app')
@section('content')

<div class="container-fluid">
   <div class="row justify-content-center">
        <h2>Posts del dia de hoy</h2> 
    </div>
    @foreach($posts as $post)
    <div class="row align-items-center h-100">
        <div class="card col-md-8 mx-auto">
            <div class="card-body">
                <h5 class="card title">
                    <a href="{{ url('/posts/'. $post->id) }}">
                        {{$post->title}}             
                    </a>
                <div>
                    {{$post->created_at}}
                <div>
                </h5>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
