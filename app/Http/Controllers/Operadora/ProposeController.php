<?php

namespace App\Http\Controllers\Operadora;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $movements = DB::table('movimentacao_cadastral')
                        ->groupByRaw('substring(movimentacao_cadastral.created_at, "-", 2)')
                        ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.id')
                        ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                        ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                        ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                        ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.data_inclusao',
                        'data_exclusao', 'administradora.nome_empresa', 'entidade.nome_entidade', 'vigencia.data', 'status.id AS statusID', 'status.status')
                        ->paginate(10);

        if (Auth::check() === true) {
           return view('administradora.dashboard', [
                'user' => $user->name,
                'users' => $user,
                'movements' => $movements
           ]);
        }

        return redirect()->route('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
