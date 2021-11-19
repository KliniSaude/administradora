<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testDoLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Entrar')
                    ->type('email', 'moises.fausto@klinisaude.com.br')
                    ->type('password', 'admin123456')
                    ->press('Entrar')
                    ->assertPathIs('/dashboard');
        });
    }
}
