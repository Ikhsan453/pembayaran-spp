<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }

}
