<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $table = "movimentacao_cadastral_dependentes";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'codigo_dependencia',
        'nome_dependente',
        'cpf_dependente',
        'sexo_dependente',
        'estado_civil_dependente',
        'nascimento_dependente',
        'filiacao_dependente',
        'numero_unico_saude_dependente',
        'numero_dn_dependente',
        'codigo_grupo_carencia_dependente',
        'codigo_grupo_carencia_odonto_dependente',
        'fk_movimentacao_cadastral',
    ];

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        if (str_contains($param, '/')) {
            return $param;
        }

        list($day, $month, $year) = explode('-', $param);
        return (new \DateTime($day . $month . $year))->format('dmY');
    }
}
