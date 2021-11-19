<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProposeRequest extends FormRequest
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
            'codigo_tipo_operacao' => 'required',
            'fk_contrato' => 'required',
            'nome_associado' => 'required',
            'cpf' => 'required',
            'sexo' => 'required',
            'estado_civil'  => 'required',
            'nascimento'  => 'required',
            'cep'  => 'required',
            'logradouro'  => 'required',
            'bairro'  => 'required',
            'cidade'  => 'required',
            'estado'  => 'required',
            'email'  => 'required|email',
            'telefone'  => 'required',
        ];
    }

    public function message()
    {
        return [
            'codigo_tipo_operacao.required' => 'O campo Tipo Operação é obrigatório.',
            'fk_contrato.required' => 'O campo Contrato é obrigatório.',
            'nome_associado.required' => 'O campo Nome Associado é obrigatório.',
        ];
    }
}
