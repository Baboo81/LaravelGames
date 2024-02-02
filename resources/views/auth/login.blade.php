@extends('base')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="text-center py-5">Please sign in</h1>
            <div class="col-md-4 mx-auto">
                <form method="POST" action="{{ route('login') }}" class="border-perso rounded-4 py-5">
                    @csrf<!--Définir ce token afin de sécuriser le form-->

                    {{--Inclusion des msg d'alertes--}}
                    @include('alerts.alert-message')

                    <!--Msg si erreur pour l'email-->
                    @error('email')
                        <div class="alert alert-danger text-center" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <!--Msg si erreur pour le mot de passe-->
                    @error('password')
                        <div class="alert alert-danger text-center" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="email" class="pb-3">Email</label>
                    <input type="email"
                           name="email"
                           id="inputEmail"
                           class="form-control @error('email') is-invalid  @enderror"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus>

                    <label for="password" class="py-3">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid  @enderror"
                           required
                           autocomplete="current-password">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check form-switch py-3">
                                <label for="form-check-label" for="toggle">Remember me</label>
                                <input class="form-check-input"
                                       name="toggle"
                                       type="checkbox"
                                       role="switch"
                                       {{ old('remember') ? 'checked' : '' }}
                                       id="toggle">
                            </div>
                        </div>
                        <div class="col-md-6 text-end py-3">
                            <a href="#">Forgot password ?</a>
                        </div>
                    </div>
                    <div class="d-grid gap-2 py-3">
                        <button class="btn btn-primary" type="submit">sign in</button>
                    </div>
                    <div>
                        <p class="text-center">No registered yet ? <a href="{{ route('register') }}">Create an account</a></p>
                    </div>
                </form>
                <br/>
                <br/>
            </div>
        </div>
    </div>
@endsection
