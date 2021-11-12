<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propose extends Model
{
    protected $table = "movimentacao_cadastral";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'codigo_tipo_operacao',
        'codigo_empresa',
        'numero_associado_titular',
        'cpf',
        'data_inclusao',
        'nome_associado',
        'nascimento',
        'codigo_plano',
        'codigo_grupo_carencia',
        'codigoGrupoCarenciaOdonto',
        'filiacao',
        'sexo',
        'estado_civil',
        'numero_dn',
        'numero_unico_saude',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'email',
        'ddd',
        'telefone',
        'data_exclusao',
        'codigo_motivo_exclusao',
        'fk_status',
        'fk_contrato',
    ];

    public function setDataInclusaoAttribute($value)
    {
        $this->attributes['data_inclusao'] = $this->convertStringToDate($value);
    }

    public function setDataExclusaoAttribute($value)
    {
        $this->attributes['data_exclusao'] = $this->convertStringToDate($value);
    }

    public function setNascimentoAttribute($value)
    {
        $this->attributes['nascimento'] = $this->convertStringToDate($value);
    }

    public function setFkStatusAttribute($value)
    {
        $this->attributes['fk_status'] = $value;
    }

    public function setFkUsuarioAttribute($value)
    {
        $this->attributes['fk_usuario'] = $value;
    }

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
