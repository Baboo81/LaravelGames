@extends('base')

@section('title', 'snake')

@section('content')
<h1>Snake</h1>

<div class="container">
    <div class="row">
        <div class="col-md-6 py-5">
            <h2 class="text-center py-5">Snake</h2>
            <canvas width="400" height="400"></canvas>
        </div>
        <div class="col-md-6 snake">

        </div>
    </div>
</div>
@endsection
