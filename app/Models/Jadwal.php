<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table='jadwal';
    protected $fillable=['id_user','start_date','end_date','keterangan'];

    public function book(){
        return $this->belongsToMany(Produk_Book::class,'produk_jadwal','id_jadwal','id_produk_book');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function pembayaran(){
        return $this->hasOne(Pembayaran::class,'id_jadwal');
    }
}
