<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $event_id
 * @property int $stage_id
 * @property string $headliners
 * @property Carbon $date
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property array $schedule
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function artistSchedule(): HasMany
    {
        return $this->hasMany(ArtistSchedule::class);
    }
}
