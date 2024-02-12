<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalJemputSampah extends Model
{
    use HasFactory;
    protected $table = 'jadwal_jemput_sampahs';
    protected $fillable = ['tanggal'];
    protected $guarded = [];

    public function jemputSampah() {
        return $this->hasOne(JemputSampah::class);
    }
}
