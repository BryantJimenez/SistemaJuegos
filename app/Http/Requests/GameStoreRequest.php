<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
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
        return [
            'couple1' => 'required|array|max:2',
            'couple1' => 'required|array|max:2',
            'type' => 'required|integer|max:1',
            'points1' => 'required|integer|min:0|max:2',
            'points2' => 'required|integer|min:0|max:2'
        ];
    }
}