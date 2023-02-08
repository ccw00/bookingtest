<?php

namespace App\Models;

use App\Models\Traits\BelongsToRoom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory, BelongsToRoom;

    protected $fillable = [
        'room_id',
        'starts_at',
        'ends_at',
    ];

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
