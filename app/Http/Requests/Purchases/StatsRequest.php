<?php

namespace App\Http\Requests\Purchases;
use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'from' => [
                'date_format:Y-m-d'
            ],
            'to' => [
                'date_format:Y-m-d'
            ],
            'typeId' => 'integer',
        ];
    }

}
