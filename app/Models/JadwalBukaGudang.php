<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBukaGudang extends Model
{
    use HasFactory;
    protected $table = 'jadwal_buka_gudangs';
    protected $fillable = ['tanggal', 'jam_operasional'];
    protected $guarded = [];
}
