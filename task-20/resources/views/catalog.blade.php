@extends('layout')
@section('main_content')
    <div class="row">

        @foreach($categories as $category)
        <div class="col-lg-3">
            <h2 class="fw-normal">{{ $category['type'] }}s</h2>
            <p>Some representative placeholder content for the three columns of text below the carousel.</p>
            <p><a class="btn btn-secondary" href="/category/{{ $category['type'] }}">View »</a></p>
        </div>
        @endforeach

    </div>
@endsection
