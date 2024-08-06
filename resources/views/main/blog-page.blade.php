@extends('layouts.main')

@section('title', $blog->title)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-3">{{ $blog->title }}</h1>
                <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" class="img-fluid mb-4">
                <p>{!! $blog->content !!}</p>
            </div>
        </div>
    </div>
@endsection