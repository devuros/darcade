<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameGenre extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'game'=> 'bail|required|integer|exists:games,id',
            'genre'=> 'bail|required|integer|exists:genres,id'
        ];
    }

}
