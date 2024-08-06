@extends('layouts.main')

@section('title', 'Blogs')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">OUR BLOGS</h1>
        <div class="row justify-content-center">
            @foreach($blogs as $blog)
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
        <div class="justify-content-center">
            <div class="pagination-links">
                {{ $blogs->render('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection