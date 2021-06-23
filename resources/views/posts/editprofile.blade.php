@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <!-- Formulario para cambiar los datos personales de la cuenta-->
                <div class="card-header">{{ __('auth.Account') }}</div>
                <div class="card-body">
                     <!---Crea un formulario que incluye el envio del id del usuario-->
                    <form method="POST" action="{{ url('/editaccount?user_id='.Auth::user()->id) }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('auth.Name')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>
                             <!--- Si se desea cambiar se debe ingresar el nuevo nombe de usuario-->
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{ Auth::user()->email}}" required autocomplete="email">
                                 <!--- Si se desea cambiar se debe ingresar el nuevo e,ail-->
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.Edit Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                 <!-- Formulario para cambiar la contraseña-->
                <div class="card-header">{{ __('auth.Change Password') }}</div>
                <div class="card-body">
                     <!-- Se envia el id del usuario al ejecutar este formulario-->
                    <form method="POST" action="{{ url('/changepassword?user_id='.Auth::user()->id) }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('auth.Old Password')}}</label>

                            <div class="col-md-6">
                                 <!-- Se debe ingresar la antigua contraseña para ser comprobada-->
                                <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" required autocomplete="old-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.New Password') }}</label>

                            <div class="col-md-6">
                                 <!-- Se debe ingresar la nueva contraseña -->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth.Confirm Password') }}</label>

                            <div class="col-md-6">
                                 <!-- Se debe ingresar una vez la nueva contraseña-->
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>              
                </div> 
                <div class="card-footer">  
                    <div class="row center">
                        <div class="col-md-6">
                             <!-- Se crea un boton que ejecuta el formulario-->
                            <button class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();" >
                            {{__('auth.Delete Profile')}}
                             </button>
                              <!-- El formulario envia el id del usuario-->
                            <form id="delete-form" action="{{ url('/deleteaccount?user_id='.Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            </form> 

                        </div>
                    </div>
                <div> 
            </div>
        </div>
    </div>
</div>
@endsection
