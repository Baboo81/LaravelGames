@extends('base')

@section('title', 'Account activation')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="text-center py-5">Account Activation</h1>
               {{--Inclusion des msg d'alertes--}}
               @include('alerts.alert-message');

                <form class="border rounded-4" method="POST" action="{{ route('app_activation_code', ['token' => $token]) }}">
                    @csrf

                    <label for="activation-code" class="py-3">Activation code</label>
                    <input class="form-control @if(Session::has('danger')) is-invalid @endif"
                           type="text"
                           name="activation-code"
                           id="activation-code"
                           value="@if(Session::has('activation_code')){{ Session::get('activation_code') }}@endif">

                    <div class="row py-3">
                        <div class="col-md-6">
                            <a href="#">Change your address</em></a>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('app_resend_activation_code', ['token' =>$token]) }}">Resend the activation code</a>
                        </div>
                    </div>

                    <div class="d-grid gap-2 py-3">
                        <button class="btn btn-primary" type="submit">Activate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
