<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function index(){
        $sepatu = DB::table('produk')->where('kategori','sepatu')->where('id_produk',3)->first();
        $tas = DB::table('produk')->where('kategori','tas')->where('id_produk',6)->first();
        $tenda = DB::table('produk')->where('kategori','tenda')->where('id_produk',9)->first();
        

        // $sepatuRandom = [];
        // foreach ($sepatu as $key1) {
        //     $sepatuRandom[] = [
        //         'id_sepatu' => 
        //     ]
        // }

        return view('frontend.home',compact('sepatu','tas','tenda'));
    }

    public function produk(){
        $produk = DB::table('produk')->get();

        $sortProduk = $produk->sortBy('kategori');

        foreach( $sortProduk as $index => $pdk){
            $number = $pdk->harga;
            $pdk->harga = number_format($number,0,'','.');
        }

        // $sepatuRandom = [];
        // foreach ($sepatu as $key1) {
        //     $sepatuRandom[] = [
        //         'id_sepatu' => 
        //     ]
        // }

        return view('frontend.produk',compact('sortProduk'));
    }

    public function kategori($category){
        $produk = DB::table('produk')->where('kategori',$category)->get();

        $sortProduk = $produk->sortBy('kategori');

        return view('frontend.produk', compact('sortProduk', 'category'));
    }

    public function sepatu(){
        $sortProduk = DB::table('produk')->where('kategori','1')->get();
        // $sortProduk = Produk::where('kategori','1')

        foreach( $sortProduk as $index => $pdk){
            $number = $pdk->harga;
            $pdk->harga = number_format($number,0,'','.');
        }

        return view('frontend.produk',compact('sortProduk'));
    }

    public function about(){
        return view('frontend.about');
    }

    public function service(){
        return view('frontend.service');
    }
}
