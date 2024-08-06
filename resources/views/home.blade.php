@extends('layouts.main')

@section('title', 'Home')
    
@section('content')
    <div class="container pt-5">
        <h1>TEST HOMEPAGE</h1>
        <div class="row">
            @foreach($randomBlogs as $blog)
            <div class="col-md-4 mb-4 blog-card">
                <div class="card shadow-sm">
                    <a href="{{ route('blog.page', $blog->slug) }}">
                        <img class="card-img-top" src="{{ $blog->thumbnail }}" alt="Card image">
                    </a>
                    <div class="card-body">
                        <a href="{{ route('blog.page', $blog->slug) }}"><h5 class="card-title">{{ $blog->title }}</h5></a>
                        <p class="card-text">{{ nl2br(strip_tags(Str::limit($blog->content, 100))) }}</p>
                        <a href="{{ route('blog.page', $blog->slug) }}" class="btn btn-primary btn-block">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection