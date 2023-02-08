<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\BookingList;
use App\Http\Requests\Booking\BookingStore;
use App\Http\Requests\Booking\BookingUpdate;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    public function store(BookingStore $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $booking = Booking::query()->create($request->validated());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->getOne(BookingResource::make($booking), Response::HTTP_CREATED);
    }

    public function update(BookingUpdate $request): JsonResponse
    {
        /** @var Booking $booking */
        $booking = $request->route(Booking::ROUTE_BINDING_ENTITY_NAME);

        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $booking->fill($validatedData)->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->getOne(BookingResource::make($booking));
    }

    public function list(BookingList $request): JsonResponse
    {
        $query = Booking::query();

        $query = $request->getConditionedQuery(Booking::class, $query);
        $query = $query->orderBy($request->getSortBy(), $request->getSortDirection());

        return response()->paginate($query, BookingResource::class, $request);
    }
}
