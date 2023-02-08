<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupancyRate\DailyOccupancyRateRequest;
use App\Http\Requests\OccupancyRate\MonthlyOccupancyRateRequest;
use App\Http\Services\OccupancyRateService;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class OccupancyRateController extends Controller
{
    public function daily(DailyOccupancyRateRequest $request): JsonResponse
    {
        $date = Arr::get($request->validated(), 'date');

        $query = Room::query();
        $query = $request->getConditionedQuery(Room::class, $query);

        $rooms = $query->withCountedOccupancies('applyDateRange', $date)->get();

        $occupancy = OccupancyRateService::compute($rooms);

        return response()->success(['occupancy_rate' => $occupancy]);
    }

    public function monthly(MonthlyOccupancyRateRequest $request): JsonResponse
    {
        $date = Arr::get($request->validated(), 'date');

        $query = Room::query();
        $query = $request->getConditionedQuery(Room::class, $query);

        $rooms = $query->withCountedOccupancies('applyMonthDateRange', $date)->get();

        $occupancy = OccupancyRateService::compute($rooms);

        return response()->success(['occupancy_rate' => $occupancy]);
    }
}
