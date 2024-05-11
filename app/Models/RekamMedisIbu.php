<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperRekamMedisIbu
 */
class RekamMedisIbu extends Model
{
    /**
     * The attribute that became primary key
     */
    protected $primaryKey = 'anak_id';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'anak_id'
    ];
}
