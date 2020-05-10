<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
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
            'name' => 'required|max:255',
            'ip' => 'required|ipv4',
            'port' => 'required|integer|min:10|max:99999999',
            'img' => 'required',
            'game_id' => 'required|exists:App\Models\Game,id',
            'category_id' => 'required|exists:App\Models\Category,id|CategoryBelongsToGame'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'port.integer' => 'The port must be a valid port',
            'port.min' => 'The port must be between 10 and 99999',
            'port.max' => 'The port must be between 10 and 99999'
        ];
    }
}
