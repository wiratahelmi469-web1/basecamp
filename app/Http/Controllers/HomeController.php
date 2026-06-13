<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use App\Models\Produk;
use App\Models\Sewa;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('produk')
            ->get();

        $produkTerbaru = Produk::latest()
            ->take(6)
            ->get();

        $artikelTerbaru = Post::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        $totalProduk = Produk::count();

        $totalPenyewaan = Sewa::count();

        $totalCustomer = User::where(
            'role',
            'customer'
        )->count();

        return view('home', compact(
            'kategori',
            'produkTerbaru',
            'artikelTerbaru',
            'totalProduk',
            'totalPenyewaan',
            'totalCustomer'
        ));
    }
}
