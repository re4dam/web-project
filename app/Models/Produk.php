<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['nama_produk','deskripsi','harga','jumlah','img_path'];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function keranjang(){
        return $this->hasMany(Keranjang::class,'id_produk');
    }
    public function book(){
        return $this->hasMany(Produk_Book::class,'id_produk');
    }
}
