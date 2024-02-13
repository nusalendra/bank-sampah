<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabahs';
    protected $fillable = ['user_id', 'nomor_register', 'nomor_kartu_keluarga', 'saldo_aktual', 'saldo_sementara', 'status'];
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
