<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk_Book extends Model
{
    use HasFactory;
    protected $table='produk_book';
    protected $fillable=['id_produk','id_user','jumlah','harga_total'];
    public function produk(){
        return $this->belongsTo(Produk::class,'id_produk','id_produk');
    }
    public function jadwal(){
        return $this->belongsToMany(Jadwal::class,'produk_jadwal','id_produk_book','id_jadwal');
    }
}
