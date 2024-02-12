<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarikSaldo extends Model
{
    use HasFactory;
    protected $table = 'tarik_saldos';
    protected $fillable = ['user_id', 'metode', 'nomor_rekening', 'jumlah_penarikan', 'total_penarikan'];
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
