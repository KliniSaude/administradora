<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route()->parameter('id');

        return [
            'name' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users,email,{$id}',
            'password' => 'required|min:6',
            'user_type' => 'required',
            'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome requerido.',
            'name.min' => 'Nome deve ter mais de três caracteres.',
            'name.max' => 'O nome deve ter no máximo 15 caracteres. Tente abreviar por favor!',
            'password.required' => 'Senha obrigatória.',
            'password.min' => 'Senha deve ter no minimo 6 caracteres.',
            'user_type.required' => 'O campo Tipo de Usuário é obrigatorio.',
            'profile_photo.mimes' => 'A imagem deve possuir um dos seguintes formatos: jpge, png, jpg e ter no máximo 2MB.',
        ];
    }
}
