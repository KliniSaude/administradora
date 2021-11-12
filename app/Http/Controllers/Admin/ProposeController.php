<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Propose;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->name;
        return view('administradora.cadastrar-proposta', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $propose = new Propose();

        $propose->fill($request->all());

        $propose->setDataInclusaoAttribute($request->data_inclusao);
        $propose->setDataExclusaoAttribute($request->data_exclusao);
        $propose->setNascimentoAttribute($request->nascimento);
        $propose->setFkStatusAttribute(1);
        $propose->setFkUsuarioAttribute($user);

        $propose->save();

        return redirect('dashboard')->with('message', 'Cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = explode('.', $id);
        $user = Auth::user()->name;

        if ($id[0] == 'in') {
            $proposals = DB::table('movimentacao_cadastral')
                            ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.contrato')
                            ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                            ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                            ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                            ->where('movimentacao_cadastral.data_inclusao', $id[1])
                            ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.nome_associado',
                            'movimentacao_cadastral.cpf', 'entidade.contrato', 'vigencia.data', 'status.id AS statusID', 'status.status')
                            ->get();
        }

        if ($id[0] == 'ex') {
            $proposals = DB::table('movimentacao_cadastral')
                            ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.contrato')
                            ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                            ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                            ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                            ->where('movimentacao_cadastral.data_exclusao', $id[1])
                            ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.nome_associado',
                            'movimentacao_cadastral.cpf', 'entidade.contrato', 'vigencia.data', 'status.id AS statusID', 'status.status')
                            ->get();
        }

        return view('administradora.ver-propostas', [
            'user' => $user,
            'proposals' => $proposals
        ]);
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

    public function dashboard()
    {
        $user = Auth::user()->name;

        $movements = DB::table('movimentacao_cadastral')
                        ->groupBy('movimentacao_cadastral.data_inclusao', 'fk_contrato')
                        ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.id')
                        ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                        ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                        ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                        ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.data_inclusao',
                        'data_exclusao', 'entidade.nome_entidade', 'vigencia.data', 'status.id AS statusID', 'status.status')
                        ->paginate(10);

        if (Auth::check() === true) {
           return view('administradora.dashboard', [
               'user' => $user,
                'movements' => $movements
           ]);
        }

        return redirect()->route('admin.login');
    }
}
