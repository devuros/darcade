<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGame extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=> 'required|string|unique:games,title',
            'image'=> 'required|image|max:500',
            'release_date'=> 'required|date',
            'description'=> 'required|string',
            'about'=> 'required|string',
            'developer'=> 'bail|required|integer|min:1|exists:developers,id',
            'publisher'=> 'bail|required|integer|min:1|exists:publishers,id',
            'base_price'=> 'required|between:0.49,99.99',
            'sale_price'=> 'nullable',
            'is_on_sale'=> 'required|boolean'
        ];
    }

}
