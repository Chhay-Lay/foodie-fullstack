<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.show', [
            'posts' => Post::where('is_published', 1)->latest()->filter(request(['search', 'category']))->paginate(5)
        ]);
    }
}
