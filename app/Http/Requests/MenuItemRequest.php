<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
                return [
                    'name' => ['sometimes'],
                    'number' => [
                        'sometimes',
                        'integer',
                        Rule::unique('menu_items')->where(function ($query) {
                            return $query->where('number', $this->number)
                                ->where('number_addition', $this->number_addition);
                        }),
                    ],
                    'number_addition' => ['nullable', 'max:3'],
                    'category_id' => ['sometimes', 'integer', 'exists:menu_categories,id'],
                    'price' => ['sometimes', 'numeric', 'min:0'],
                    'description' => ['nullable'],
                ];

            default:
                return [
                    'name' => ['required'],
                    'number' => [
                        'required',
                        'integer',
                        Rule::unique('menu_items')->where(function ($query) {
                            return $query->where('number', $this->number)
                                ->where('number_addition', $this->number_addition);
                        }),
                    ],
                    'number_addition' => ['nullable', 'max:3'],
                    'category_id' => ['required', 'integer', 'exists:menu_categories,id'],
                    'price' => ['required', 'numeric', 'min:0'],
                    'description' => ['nullable'],
                ];
        }
    }
}
