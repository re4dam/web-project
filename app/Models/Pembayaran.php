<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table='pembayaran';
    protected $fillable = ['id_jadwal','metode','total','bukti'] ;

    public function jadwal(){
        return $this->belongsTo(Jadwal::class,'id_jadwal');
    }

    // Define a getter accessor for the composite attribute
    public function getMetodeAttribute($value)
    {
        // Decode the JSON string to get the composite attribute value
        $metode = json_decode($value, true);
        
        return $metode;
    }

    // Define a setter mutator for the composite attribute
    public function setMetodeAttribute($value)
    {
        // Encode the composite attribute value as JSON string
        $this->attributes['metode'] = json_encode($value);
    }
}
