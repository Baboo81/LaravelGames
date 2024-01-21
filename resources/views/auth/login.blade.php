@extends('base')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center py-5">Please sign in</h1>
                <p class="text-center py-3">Your articles are waiting for you</p>

                <form method="POST" action="{{ route('login') }}" class="border rounded-4">
                    @csrf<!--Définir ce token afin de sécuriser le form-->

                    <!--Msg si erreur pour l'email-->
                    @error('email')
                        <div class="alert alert-danger text-center" role="alert">
                            {{ $emailError }}
                        </div>
                    @enderror

                    <!--Msg si erreur pour le mot de passe-->
                    @error('password')
                        <div class="alert alert-danger text-center" role="alert">
                            {{ $passwordError }}
                        </div>
                    @enderror

                    <label for="email" class="py-3">Email</label>
                    <input type="email"
                           name="email"
                           id="inputEmail"
                           class="form-control"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus>

                    <label for="password" class="py-3">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           required
                           autocomplete="current-password">

                    <div class="row">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
