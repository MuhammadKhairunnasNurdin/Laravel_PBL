<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kader extends Model
{
    /**
     * The attribute that became primary key
     */
    protected $primaryKey = 'kader_id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'kader_id'
    ];

    /**
     * Eloquent Model Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class, 'NIK', 'NIK');
    }
    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'kader_id', 'kader_id');
    }
    public function artikels(): HasMany
    {
        return $this->hasMany(Artikel::class, 'kader_id', 'kader_id');
    }
    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'kader_id', 'kader_id');
    }

}
