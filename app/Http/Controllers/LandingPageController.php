<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function indexHome() {
        return view('pages.home');
    }
    public function indexProduk() {
        $produk = Produk::where('status', 'active')->orderBy('created_at', 'desc')->paginate(8);
        return view('pages.produk', compact('produk'));
        }
    public function indexGalery() {
        $galery = Galery::where('status', 'active')->orderBy('created_at', 'desc')->get();
        return view('pages.galery', compact('galery'));
    }
}
