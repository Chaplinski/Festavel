<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $hometown
 * @property string $genre
 * @property string $description
 * @property array $members //might be something like "guitar/piano/vocals" => "Steve Winwood"
 * @property string $website_url
 * @property string $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Artist extends Model
{
    use HasFactory;

    protected $table = 'artists';

    public function artistSchedule(): HasMany
    {
        return $this->hasMany(ArtistSchedule::class);
    }
}
