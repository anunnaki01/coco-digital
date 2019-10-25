<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Service
 * @package App\Models
 */
class Service extends Model
{
    /**
     * @var string
     */
    protected $table = 'service';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'preparation',
        'time',
        'place_id',
        'is_enabled'
    ];

    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
