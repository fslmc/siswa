<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = ['title', 'content', 'slug', 'thumbnail'];

}
