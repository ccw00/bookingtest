<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\BaseRequest;

class BookingUpdate extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'starts_at' => [
                'nullable',
                'date',
                'after:today',
            ],
            'ends_at' => [
                'nullable',
                'date',
                'after:starts_at',
            ],
        ];
    }
}
