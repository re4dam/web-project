<?php

namespace Database\Seeders;

use App\Models\Produk as ModelsProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Produk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsProduk::create([
            'nama_produk' => 'Columbia',
            'deskripsi' => 'Sepatu kulit yang cocok untuk anda bergaya dan berkemah di alam',
            'kategori' => 'sepatu',
            'harga' => '70000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/shoe-columbia.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Keen',
            'deskripsi' => 'Sepatu yang direkomendasikan untuk all rounder, jalan tengah dalam semua kondisi',
            'kategori' => 'sepatu',
            'harga' => '50000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/shoe-keen.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Nortiv',
            'deskripsi' => 'Sepatu dengan bahan yang kokoh dan tahan cuaca ekstrem alam',
            'kategori' => 'sepatu',
            'harga' => '105000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/shoe-nortiv.jpg',
        ]);
        
        ModelsProduk::create([
            'nama_produk' => 'Venture Pal',
            'deskripsi' => 'Tas yang cocok untuk mendaki dengan peralatan yang dipadatkan',
            'kategori' => 'tas',
            'harga' => '50000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/bag-venturepal.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Water Buffalo',
            'deskripsi' => 'Tas untuk anda yang membutuhkan hidrasi dan penyimpanan yang cukup',
            'kategori' => 'tas',
            'harga' => '75000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/bag-waterbuffalo.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Wintming',
            'deskripsi' => 'Tas besar yang dapat menyimpan alat-alat kemah dalam satu tas',
            'kategori' => 'tas',
            'harga' => '95000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/bag-wintming.jpg',
        ]);

        ModelsProduk::create([
            'nama_produk' => 'Eiger Shira 1p',
            'deskripsi' => 'Tenda Eiger yang yang memiliki ketahanan terbaik dalam badai',
            'kategori' => 'tenda',
            'harga' => '250000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/tent-eiger.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Tenda Naturehike Cloud Up 2X 20D NH17T001-T 2P',
            'deskripsi' => 'Tenda Naturehike cocok untuk menampung jumlah orang hingga enam orang!',
            'kategori' => 'tenda',
            'harga' => '200000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/tent-naturehike.jpg',
        ]);
        ModelsProduk::create([
            'nama_produk' => 'Tenda Consina Magnum 6',
            'deskripsi' => 'Tenda Consina dengan ukuran dan kapasitas yang cukup untuk jumlah satu hingga tiga orang',
            'kategori' => 'tenda',
            'harga' => '110000',
            'jumlah' => '10',
            'img_path' => 'images/tempo/tent-consina.jpg',
        ]);
    }
}
