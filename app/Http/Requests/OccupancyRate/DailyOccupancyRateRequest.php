<?php

namespace App\Http\Requests\OccupancyRate;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\RequestScopedAdditional;
use App\Models\Room;

class DailyOccupancyRateRequest extends BaseRequest
{
    use RequestScopedAdditional;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function applyScopes(): array
    {
        return [
            'room_ids' => 'applyRoomIds',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'room_ids' => [
                'nullable',
                'array',
            ],
            'room_ids.*' => [
                'nullable',
                'integer',
                'exists:' . Room::class . ',id',
            ],
        ];
    }
}
