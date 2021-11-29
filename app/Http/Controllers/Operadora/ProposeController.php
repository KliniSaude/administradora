<?php

namespace App\Http\Controllers\Operadora;

use App\Propose;
use App\Dependent;
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
           return view('operadora.dashboard', [
                'user' => $user,
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
        $id = explode('.', $id);
        $month = explode('-', $id[1]);

        $user = Auth::user();

        if ($id[0] == 'in') {
            $proposals = DB::table('movimentacao_cadastral')
                            ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.contrato')
                            ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                            ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                            ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                            ->whereRaw('substring_index(substring_index(created_at, "-", 2), "-", -1)', $month[1])
                            ->whereNull('deleted_at')
                            ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.nome_associado',
                            'movimentacao_cadastral.cpf', 'movimentacao_cadastral.mensagem', 'entidade.nome_entidade', 'vigencia.data', 'status.id AS statusID', 'status.status')
                            ->get();
        }

        if ($id[0] == 'ex') {
            $proposals = DB::withTrashed()
                            ->table('movimentacao_cadastral')
                            ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.contrato')
                            ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                            ->join('vigencia', 'entidade.fk_vigencia', '=', 'vigencia.id')
                            ->join('status', 'movimentacao_cadastral.fk_status', '=', 'status.id')
                            ->where('movimentacao_cadastral.data_exclusao', $month[1])
                            ->whereNull('deleted_at')
                            ->select('movimentacao_cadastral.id', 'movimentacao_cadastral.nome_associado',
                            'movimentacao_cadastral.cpf', 'entidade.contrato', 'vigencia.data', 'status.id AS statusID', 'status.status')
                            ->get();
        }

        $dependents = DB::table('movimentacao_cadastral')
                        ->join('movimentacao_cadastral_dependentes', 'movimentacao_cadastral.id', '=', 'movimentacao_cadastral_dependentes.fk_movimentacao_cadastral')
                        ->select('movimentacao_cadastral_dependentes.id', 'movimentacao_cadastral_dependentes.nome_dependente',
                                'movimentacao_cadastral_dependentes.cpf_dependente', 'movimentacao_cadastral_dependentes.fk_movimentacao_cadastral')
                        ->get();

        return view('operadora.ver-propostas', [
            'user' => $user,
            'users' => $user,
            'proposals' => $proposals,
            'dependents' => $dependents
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
        $user = Auth::user();
        $entities = DB::table('administradora')
                        ->join('users', 'users.fk_administradora', '=', 'administradora.id')
                        ->join('entidade', 'entidade.fk_administradora', '=', 'administradora.id')
                        ->join('vigencia', 'vigencia.id', '=', 'entidade.fk_vigencia')
                        ->select('entidade.contrato', 'entidade.nome_entidade', 'vigencia.data')
                        ->orderBy('entidade.nome_entidade')
                        ->orderBy('vigencia.data')
                        ->get();

        $propose = Propose::where('id', $id)->first();
        $dependents = Dependent::where('fk_movimentacao_cadastral', $id)->get();

        return view('operadora.editar-proposta', [
            'user' => $user,
            'users' => $user,
            'entities' => $entities,
            'propose' => $propose,
            'dependents' => $dependents
        ]);
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
