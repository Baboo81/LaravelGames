@extends('base')

@section('title', 'snake')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 py-5">
            <h1 class="text-end py-5">Snake</h1>
            <canvas width="400" height="400"></canvas>
        </div>
        <div class="col-md-6 snake">

        </div>
    </div>
</div>
@endsection
