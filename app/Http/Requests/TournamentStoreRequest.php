<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentStoreRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:191',
            'groups' => 'required|integer|min:1|max:6',
            'couples' => 'required|integer|min:2|max:6',
            'start' => 'required|date',
            'type' => 'required|string'
        ];
    }
}
