<?php

namespace App\Http\Requests\Purchases;
use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'file' => [
                'required',
            ]
        ];
    }

}
