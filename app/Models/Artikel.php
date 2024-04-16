<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artikel extends Model
{
    /**
     * The attribute that became primary key
     */
    protected $primaryKey = 'artikel_id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'artikel_id'
    ];

    /**
     * Eloquent Model Relationship
     */
    public function kader(): BelongsTo
    {
        return $this->belongsTo(Kader::class, 'kader_id', 'kader_id');
    }
}
