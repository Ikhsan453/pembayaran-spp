<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    //
    protected $guarded = [];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    
}
    