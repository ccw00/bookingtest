<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\RequestListAdditional;
use App\Http\Requests\RequestScopedAdditional;
use Illuminate\Validation\Rule;

class BookingList extends BaseRequest
{
    use RequestListAdditional, RequestScopedAdditional;

    protected static array $allowedSortByKeys = [
        'created_on',
        'updated_on',
    ];

    /**
     * Sort by keys mapped for request parameters
     *
     * @var array|string[]
     */
    protected static array $sortByMappings = [
        'created_on' => 'created_at',
        'updated_on' => 'updated_at',
    ];

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
            'date_start' => 'applyStartsAt',
            'date_end' => 'applyEndsAt',
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
            'sortBy' => [
                'nullable',
                'string',
                Rule::in(self::$allowedSortByKeys),
            ],
            'sortDirection' => [
                'nullable',
                'string',
                Rule::in(self::$allowedSortDirectionKeys),
            ],
            'date_start' => [
                'nullable',
                'date',
            ],
            'date_end' => [
                'nullable',
                'date',
                'after:date_start',
            ],
        ];
    }
}
