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
        $produk = Produk::all();
        return view('pages.produk', compact('produk'));
        }
    public function indexGalery() {
        $galery = Galery::all();
        return view('pages.galery', compact('galery'));
    }
}
