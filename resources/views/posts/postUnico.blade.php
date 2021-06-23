@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <img
                   src="{{ Storage::url($post->image)}}"  
                   all="..." 
                   class="card-img-top"               
                 >

                 <img
                   src="{{ asset('storage/'.$post->image)}}"  
                   all="..." 
                   class="card-img-top"               
                 >
                <div class="card-body">
                    @auth  <!--- Si está logeado ser realizará la siguiente condicional-->
                        @if ($post->user->id == Auth::user()->id)  <!--- Si la persona que publicó el post es la misma que está logeada-->
                        <div class="card-group">
                            <div class=" md-col-3">
                                <button class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('delete-form').submit();" >  <!--- Se crea un boton que ejecuta un formulario-->
                                {{__('auth.Delete Post')}}
                                </button>
                                <form id="delete-form" action="{{ url('/delete?post_id='.$post->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf   <!--- Se crea un formulario que envia el id del posta-->
                                </form>                       
                            </div>  
                        </div>    
                        @endif    
                    @endauth
                    
                  
                    <h5 class="card-title">
                        {{$post->title}} <!--Cargar el dato title según el id del url -->
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{$post->created_at->toFormattedDateString()}}  <!--- carga la fecha en un formato -->
                    </h6>
                    <p class="card-text">
                        {{$post->content}} <!--Cargar el dato content según el id del url -->             
                    </p> 
                </div>
                <a href="{{url('/posts')}}" class="card-link"><!--Redirecciona a la página principal -->
                    Todas las publicaciones 
                </a>
            </div>
        </div>
        @auth
         <form action="{{ url('/comments?post_id='.$post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-md-8 col-form-label" for="content">
                    {{__('Comment')}}
                </label>
                <div class="col-md-8">
                    <textarea
                        id="content"
                        class="form-control @error('content') ls-invalid @enderror"
                        name="content" rows="3">{{old('content')}}
                    </textarea>
                    @error('content')
                    <span class="invalid-feedback">
                        <strong>{{ $message}}</strong>
                    </span>   
                    @enderror  
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <button class="btn btn-primary">
                        {{__('create')}}
                    </button>
                </div>
            </div>
         </form>
        @else 
        <div class=" alert alert-secondary" role="alert">
            <p>
                Si deseas comentar <a href="{{url('/login')}}">Inicia Sesión</a> o <a href="{{url('register')}}">registrate</a>
            </p>
        </div>
        @endauth
        @forelse ($post->comments as $comment)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$comment->user->name}}
                    </h5>
                    <h6 class=" card-subtitle mb-2 text-muted">
                        {{$comment->created_at->toFormattedDateString()}}
                    </h6>
                    <p class="card-text">
                        {{$comment->content}}
                    </p>
                </div>
            </div>
        @empty
            <p>No hay comentarios para esta publicación, se el primero</p>
        @endforelse        
    </div>
</div>
@endsection
