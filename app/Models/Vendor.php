<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $power_needs
 * @property string $hometown
 * @property string $description_short
 * @property string $description_long
 * @property string $address
 * @property string $image_url
 * @property string $website_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';

    public function vendorEvents(): HasMany
    {
        return $this->hasMany(VendorEvent::class);
    }

    public function vendorVenues(): HasMany
    {
        return $this->hasMany(VendorVenue::class);
    }
}
