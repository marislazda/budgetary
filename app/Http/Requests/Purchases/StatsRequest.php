<?php

namespace App\Http\Requests\Purchases;
use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'from' => 'required',
            'to' => 'required',
            'type' => 'integer',
            'subType' => 'integer'
        ];
    }

}
