<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class BaseRequest extends FormRequest
{
    use ValidatesRequests;

    public function validationData()
    {
        return array_merge(parent::validationData(), $this->route()->parameters());
    }
}
