<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;

trait RequestListAdditional
{
    protected static array $allowedSortDirectionKeys = [
        'asc',
        'desc',
    ];

    public function getSortBy(): string
    {
        return Arr::get(self::$sortByMappings, $this->input('sortBy', 'created_on'));
    }

    public function getSortDirection(): string
    {
        return $this->input('sortDirection', 'desc');
    }
}
