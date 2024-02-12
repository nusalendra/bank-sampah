<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JemputSampah extends Model
{
    use HasFactory;
    protected $table = 'jemput_sampahs';
    protected $fillable = ['user_id', 'jadwal_jemput_sampah_id', 'status'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function jadwalJemputSampah()
    {
        return $this->belongsTo(JadwalJemputSampah::class);
    }
}
