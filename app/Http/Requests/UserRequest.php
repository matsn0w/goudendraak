<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'code' => ['required', 'integer', "unique:users,code,$this->id"],
                    'checked' => ['required', 'array', 'min:1'],
                    'checked.*' => ['integer', 'exists:roles,id'],
                    'password' => ['sometimes', 'min:1'],
                ];

            default:
                return [
                    'code' => ['required', 'integer', 'unique:users,code'],
                    'checked' => ['required', 'array', 'min:1'],
                    'checked.*' => ['required', 'integer'],
                    'password' => ['required'],
                ];
        }
    }
}
