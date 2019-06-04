<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGestionRequest extends FormRequest
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
            "categoria_id"=>"required|exists:categorias,id",
            "severidad"=>"required|in:M,B,A",
            "titulo"=>"required|max:150",
            "descripcion"=>"required|max:255"
        ];
    }
}
