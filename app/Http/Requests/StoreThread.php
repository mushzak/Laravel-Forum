<?php

namespace App\Http\Requests;

use App\Rules\EndWithDot;
use Illuminate\Foundation\Http\FormRequest;

class StoreThread extends FormRequest
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
            'title' => 'required|regex:/^[A-Za-z\s-_]+$/|min:3',
            'content' => ['max:255', new EndWithDot()]
        ];
    }
}
