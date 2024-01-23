@extends('base')

@section('title', 'Flying Duky')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-mg-6">
                <h1 class="text-center py-5">Duky</h1>
                <div class="background"></div>
                <img src="/games/public/assets/img/canard.svg" alt="invalid-img" class="bird" id="bird-1">
                    <div class="message">
                        Enter To Start Game <p><span style="color:red">&uarr;</span> ArrowUp to Control</p>
                    </div>
                    <div class="score">
                        <span class="score_title"></span>
                        <span class="score_val"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
