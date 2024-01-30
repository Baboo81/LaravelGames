@extends('base')

@section('title', 'snake')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="snakeBg">
                <h1 class="text-center py-5 mainTitle">Snake</h1>
                <canvas width="400" height="400"></canvas>
            </section>
        </div>
    </div>
</div>
@endsection
