<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }
    
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

}
