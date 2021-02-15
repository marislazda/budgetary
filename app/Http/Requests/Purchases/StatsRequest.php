<?php

namespace App\Http\Requests\Purchases;
use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'from' => [
                'format:Y-m-d'
            ],
            'to' => [
                'format:Y-m-d'
            ],
            'type' => 'integer',
            'subType' => 'integer'
        ];
    }

}
