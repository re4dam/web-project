<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = ['id_jadwal','bukti_serah','bukti_kembali'];

    public function jadwal(){
        return $this->belongsTo(Jadwal::class,'id_jadwal');
    }
}
