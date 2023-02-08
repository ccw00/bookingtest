<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'room_id');
    }

    public function notAvailableBlocks(): HasMany
    {
        return $this->hasMany(Block::class, 'room_id');
    }

    public function getBookings(): Collection
    {
        return $this->bookings()->get();
    }

    public function getNotAvailableBlocks(): Collection
    {
        return $this->notAvailableBlocks()->get();
    }

    public function scopeHasOneEmptyCapacity(): int
    {
        $bookingsCount = $this->bookings()->count();
        $notAvailableBlocksCount = $this->notAvailableBlocks()->count();

        return ($this->capacity - ($bookingsCount + $notAvailableBlocksCount)) > 0;
    }

    public function scopeApplyRoomIds(Builder $query, array | string $roomIds): Builder
    {
        return $query->whereIn('id', is_array($roomIds) ? $roomIds : [$roomIds]);
    }

    public function scopeWithCountedOccupancies(Builder $query, string $scopeName, string $date)
    {
        return $query->withCount([
            'bookings' => function ($qb) use ($scopeName, $date) {
                $qb->{$scopeName}($date);
            },
            'notAvailableBlocks' => function ($qn) use ($scopeName, $date) {
                $qn->{$scopeName}($date);
            },
        ]);
    }
}
