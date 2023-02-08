<?php

namespace App\Models;

use App\Models\Traits\BelongsToRoom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, BelongsToRoom;

    protected $fillable = [
        'room_id',
        'starts_at',
        'ends_at',
    ];

    public const ROUTE_BINDING_ENTITY_NAME = 'booking';

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->findOrFail($value);
    }

    public function scopeApplyStartsAt(Builder $query, string $date): Builder
    {
        return $query->where('starts_at', '>=', $date);
    }

    public function scopeApplyEndsAt(Builder $query, string $date): Builder
    {
        return $query->where('ends_at', '<=', $date);
    }

    public function scopeApplyDateRange(Builder $query, string $date): Builder
    {
        return $query
            ->whereDate('starts_at', '<=', $date)
            ->whereDate('ends_at', '>=', $date);
    }

    public function scopeApplyMonthDateRange(Builder $query, string $date): Builder
    {
        $carbon = Carbon::make($date);

        return $query
            ->whereYear('starts_at', '<=', $carbon->year)
            ->whereYear('ends_at', '>=', $carbon->year)
            ->whereMonth('starts_at', '<=', $carbon->month)
            ->whereMonth('ends_at', '>=', $carbon->month);
    }
}
