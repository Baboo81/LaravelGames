@extends('base')

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center py-5">Register</h1>
                <p class="text-center">Create an account</p>

                <form method="POST" class="row g-3" action="{{ route('register') }}" id="form-register">
                    @csrf <!--Token csrf; pour protéger le formulaire-->

                    <div class="col-md-6">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text"
                               class="form-control"
                               id="firstname"
                               name="firstname"
                               value="{{ old('firstname') }}"
                               required
                               autocomplete="firstname"
                               autofocus>
                               <small class="text-danger fw-bold" id="errorRegisterFirstName"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text"
                               class="form-control"
                               id="lastname"
                               name="lastname"
                               value="{{ old('lastname') }}"
                               required
                               autocomplete="lastname"
                               autofocus>
                               <small class="text-danger fw-bold" id="errorRegisterLastName"></small>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus>
                               <small class="text-danger fw-bold" id="errorRegisterEmail"></small>
                    </div>
                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               value="{{ old('password') }}"
                               required
                               autocomplete="password"
                               autofocus>
                               <small class="text-danger fw-bold" id="errorRegisterPassword"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="passwordConfirm" class="form-label">Confirm Password</label>
                        <input type="password"
                               class="form-control"
                               id="passwordConfirm"
                               name="passwordConfirm"
                               value="{{ old('passwordConfirm') }}"
                               required
                               autocomplete="passwordConfirm"
                               autofocus>
                               <small class="text-danger fw-bold" id="errorRegisterPasswordConfirm"></small>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms">
                            <label class="form-check-label" for="agreeTerms">
                                Agree Terms
                            </label><br/>
                        </div>
                        <small class="text-danger fw-bold" id="errorRegisterAgreeTerms"></small>
                    </div>
                    <div class="col-12 d-grid gap-2">
                        <button type="button" class="btn btn-primary" id="registerUser">Register</button>
                    </div>
                    <div>
                        <p class="text-center">Already have an account ?<a href="{{ route('login') }}">Login</a></p>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection
