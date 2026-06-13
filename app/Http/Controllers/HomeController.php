<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Firefly\FilamentBlog\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()
            ->take(6)
            ->get();

        $posts = Post::latest()
            ->take(3)
            ->get();

        return view('customer.home', compact(
            'produks',
            'posts'
        ));
    }
}
