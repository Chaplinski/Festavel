<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected $table = 'events';
}
