<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ];
    }
}
