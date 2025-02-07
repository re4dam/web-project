<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori as ModelKategori;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelKategori::create([
            'nama' => 'Sepatu'
        ]);
        ModelKategori::create([
            'nama' => 'Tas'
        ]);
        ModelKategori::create([
            'nama' => 'Tenda'
        ]);
    }
}
