<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | My Website</title>
    <link rel="stylesheet" href="{{ asset('public/build/assets/app-ba1aece6.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blogs</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="pt-5">
        @yield('content')
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>&copy; 2023 My Website</p>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p>Subscribe to our newsletter:</p>
                    <form>
                        <input type="email" placeholder="Enter your email address">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <p class="text-center">Powered by <a href="https://laravel.com" title="Laravel">Laravel</a></p>
    </footer>
    <script src="{{ asset('build/assets/app-1b4a2663.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>