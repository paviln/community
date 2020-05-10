<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    private $validplatforms = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->validplatforms = config('platforms');

        dump($this->validplatforms);

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
            'name' => 'required',
            'platform' => [
                'required',
                Rule::in($this->validplatforms),
            ]
        ];
    }
}
