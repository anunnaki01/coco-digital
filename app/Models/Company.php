<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App\Models
 */
class Company extends Model
{
    /**
     * @var string
     */
    protected $table = 'company';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'active'];

    /**
     * @return HasMany
     */
    public function places(): HasMany
    {
        return $this->hasMany(Place::class);

    }
}
