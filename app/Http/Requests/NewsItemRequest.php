<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsItemRequest extends FormRequest
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
                    'title' => ['sometimes', 'required', 'min:1', 'string'],
                    'body' => ['sometimes', 'required', 'min:1', 'max:65535'],
                ];

            default:
                return [
                    'title' => ['required', 'min:1', 'string'],
                    'body' => ['required', 'min:1', 'max:65535'],
                ];
        }
    }
}
