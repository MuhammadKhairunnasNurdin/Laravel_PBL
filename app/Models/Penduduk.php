<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penduduk extends Model
{
    /**
     * The attribute that became primary key
     */
    protected $primaryKey = 'NIK';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'NIK'
    ];

    /**
     * Eloquent Model Relationships
     */
    public function kader(): HasOne
    {
        return $this->hasOne(Kader::class, 'NIK', 'NIK');
    }
    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'NIK', 'NIK');
    }
    public function bantuanPangans(): HasMany
    {
        return $this->hasMany(BantuanPangan::class, 'NIK', 'NIK');
    }
}
