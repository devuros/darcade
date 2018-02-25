<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScreenshot extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'screenshot'=> 'required|image',
            'game'=> 'required|integer|exists:games,id',
        ];
    }

}
