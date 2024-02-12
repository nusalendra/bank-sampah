<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahSetorSampah extends Model
{
    use HasFactory;
    protected $table = 'sampah_setor_sampah';
    protected $fillable = ['sampah_id', 'setor_sampah_id', 'berat_sampah', 'total_setoran'];
    protected $guarded = [];

    public function sampah() {
        return $this->belongsTo(Sampah::class);
    }

    public function setorSampah() {
        return $this->belongsTo(SetorSampah::class);
    }
}
