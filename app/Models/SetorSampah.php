<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetorSampah extends Model
{
    use HasFactory;
    protected $table = 'setor_sampahs';
    protected $fillable = ['user_id', 'tanggal', 'bukti_setor', 'status'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sampah()
    {
        return $this->belongsToMany(Sampah::class);
    }

    public function sampahSetorSampah()
    {
        return $this->belongsToMany(SampahSetorSampah::class, 'sampah_setor_sampah', 'setor_sampah_id', 'sampah_id');
    }
}
