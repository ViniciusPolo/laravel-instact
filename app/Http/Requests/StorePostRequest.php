<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'photo' => 'require|mimes:jpg,bmp,png' ,
            'description' => 'required'   
            //não pode haver post sem foto por isso o require na foto, mimes, somente aqueles tipos de imagem
        ];
    }

    public function messages()
    {
        return [
            'photo.required' => 'A imagem é obrigatória', //caso não colocar retornará mensegem default em inglês
            'photo.mines' => 'Extensão não suportada',
            'description.required' => 'A descrição é obrigatória'
        ];
    }

}
