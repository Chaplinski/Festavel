<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $image_url
 * @property string $website_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Venue extends Model
{
    use HasFactory;

    protected $table = 'venues';

    public function vendorVenues(): HasMany
    {
        return $this->hasMany(VendorVenue::class);
    }

    public function eventVenues(): HasMany
    {
        return $this->hasMany(EventVenue::class);
    }
}
