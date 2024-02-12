<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_transaksis';
    protected $fillable = ['user_id', 'judul', 'deskripsi'];
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
