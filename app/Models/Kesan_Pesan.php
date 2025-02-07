<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesan_Pesan extends Model
{
    use HasFactory;
    protected $table = 'kesan_pesan';
    protected $fillable = ['id_user','kesan','pesan'];

    public function user(){
        return $this->belongsTo('users');
    }
}
