@extends('base')

@section('title', 'Change your email address')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center py-5">Change your email address</h1>

                <form class="text-center border rounded-3" method="post" action=" {{ route('app_activation_account_change_email', ['token' => $token]) }} ">
                    @csrf

                    {{--Inclusion des msg d'alertes--}}
                    @include('alerts.alert-message')

                    <div class="mb3">
                        <label for="new-email" class="form-label py-3">New email address</label>
                        <input type="email"
                               name="new-email"
                               id="new-email"
                               placeholder="Enter the new address email"
                               value="@if(Session::has('new_email')){{ Session::get('new_email') }} @endif"
                               class="form-control mb-3 @if(Session::has('danger')) is-invalid @endif"
                               required>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Change</button>
                    </div>
                </form>
                <br/>
                <br/>
            </div>
        </div>
    </div>
@endsection
