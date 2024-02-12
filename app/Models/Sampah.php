<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;
    protected $table = 'sampahs';
    protected $fillable = ['nama', 'jenis', 'harga_per_kg'];
    protected $guarded = [];

    public function setorSampah()
    {
        return $this->belongsToMany(SetorSampah::class);
    }

    public function sampahSetorSampah()
    {
        return $this->belongsToMany(SampahSetorSampah::class, 'sampah_setor_sampah', 'sampah_id', 'setor_sampah_id');
    }
}
