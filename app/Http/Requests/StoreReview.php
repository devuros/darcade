<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'game'=> 'required|integer|exists:games,id',
            'recommended'=> 'required|boolean',
            'body'=> 'required|string'
        ];
    }

}
