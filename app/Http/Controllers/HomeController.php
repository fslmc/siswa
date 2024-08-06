<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BlogController;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Illuminate\Pagination\Paginator;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $randomBlogs = DB::table('blog')->inRandomOrder()->take(3)->get();
        return view('home', compact('randomBlogs'));
    }

    public function show($slug){
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('main.blog-page', compact('blog'));
    }

    public function blogs(){
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5); // retrieve all blogs with pagination, 3 per page
        return view('main.blogs', compact('blogs'));
    }
    
}
