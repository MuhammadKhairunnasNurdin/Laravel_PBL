<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperArtikel
 */
class Artikel extends Model
{
    /**
     * The attribute that became primary key
     */
    protected $primaryKey = 'artikel_id';


    protected $fillable = [
        'kader_id',
        'judul',
        'isi',
        'tag',
        'foto_artikel_path'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'foto_artikel_path',
    ];

    public function foto_artikel_path(): Attribute
    {
        return Attribute::make(
            get: fn($foto_artikel_path) => url('storage/' . $foto_artikel_path)
        );
    }

    /**
     * Eloquent Model Relationship
     */
    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class, 'kader_id', 'kader_id');
    }
}
