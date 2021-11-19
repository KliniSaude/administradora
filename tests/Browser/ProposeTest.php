<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProposeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDoNewPropose()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/nova-proposta')
                    ->select('codigo_tipo_operacao', '2')
                    ->select('fk_contrato', '117')
                    ->press('@NextButtonStep1')

                    ->type('nome_associado', 'Ariel Lorenzo')
                    ->type('cpf', '122985536289')
                    ->select('sexo', 'M')
                    ->select('estado_civil', '2')
                    ->type('filiacao', 'dona Matilda')
                    ->type('nascimento', '17/04/1992')
                    ->type('numero_unico_saude', '99987')
                    ->type('numero_dn', '887755')
                    ->select('codigo_grupo_carencia', '6601')
                    ->select('codigoGrupoCarenciaOdonto', '8801')
                    ->press('@NextButtonStep2')

                    ->press('.remover')
                    ->press('@NextButtonStep3')

                    ->type('cep', '21831440')
                    ->type('logradouro', 'Rua Projetada É trav. 2')
                    ->type('numero', '5')
                    ->type('complemento', 'casa')
                    ->type('bairro', 'Senador Camara')
                    ->type('cidade', 'Rio de Janeiro')
                    ->type('estado', 'Rio de Janeiro')
                    ->press('@NextButtonStep4')

                    ->type('email', 'moises_system@yahoo.com.br')
                    ->type('ddd', '21')
                    ->type('telefone', '32916520')
                    ->press('@NextButtonStep5')

                    ->type('codigo_plano', '3002')
                    ->press('@SendForm')

                    ->assertPathIs('/dashboard');
        });
    }
}
