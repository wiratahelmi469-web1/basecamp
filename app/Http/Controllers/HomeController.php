<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Sewa;
use Firefly\FilamentBlog\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {

            $flashSale = Produk::latest()
                ->take(6)
                ->get();

            $produkTerbaru = Produk::latest()
                ->take(8)
                ->get();

            $kategori = Kategori::all();

            $riwayat = Sewa::where(
                'user_id',
                auth()->id()
            )
                ->latest()
                ->take(5)
                ->get();

            return view(
                'customer.marketplace',
                compact(
                    'flashSale',
                    'produkTerbaru',
                    'kategori',
                    'riwayat'
                )
            );
        }

        $produks = Produk::latest()
            ->take(6)
            ->get();

        $posts = Post::latest()
            ->take(3)
            ->get();

        return view(
            'customer.home',
            compact(
                'produks',
                'posts'
            )
        );
    }
}
