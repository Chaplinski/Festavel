<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $promoter
 * @property string $website_url
 * @property string $headliners
 * @property string $second_headliners
 * @property string $third_headliners
 * @property string $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    public function venues(): HasMany
    {
        return $this->hasMany(Venue::class);
    }

    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }

    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
