<?php

namespace App\Http\Requests\Purchases;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'product' => [
                'required',
                'string'
            ],
            'type_id' => [
                'integer'
            ],
            'price' => [
                'required',
                'numeric'
            ],
        ];
    }

}
