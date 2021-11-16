<?php

namespace App\Http\Controllers\Admin;

use App\Dependent;
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
        $entities = DB::table('administradora')
                        ->join('users', 'users.fk_administradora', '=', 'administradora.id')
                        ->join('entidade', 'entidade.fk_administradora', '=', 'administradora.id')
                        ->join('vigencia', 'vigencia.id', '=', 'entidade.fk_vigencia')
                        ->select('entidade.contrato', 'entidade.nome_entidade', 'vigencia.data')
                        ->orderBy('entidade.nome_entidade')
                        ->orderBy('vigencia.data')
                        ->get();

        return view('administradora.cadastrar-proposta', [
            'user' => $user,
            'entities' => $entities
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

        if ($request->codigo_dependencia){

            foreach ($request->codigo_dependencia as $key => $codigo_dependencia) {
                $dependentArray[$key]['codigo_dependencia'] = $codigo_dependencia;
            }

            foreach ($request->nome_dependente as $key => $nome_dependente) {
                $dependentArray[$key]['nome_dependente'] = $nome_dependente;
            }

            foreach ($request->cpf_dependente as $key => $cpf_dependente) {
                $dependentArray[$key]['cpf_dependente'] = $cpf_dependente;
            }

            foreach ($request->sexo_dependente as $key => $sexo_dependente) {
                $dependentArray[$key]['sexo_dependente'] = $sexo_dependente;
            }

            foreach ($request->estado_civil_dependente as $key => $estado_civil_dependente) {
                $dependentArray[$key]['estado_civil_dependente'] = $estado_civil_dependente;
            }

            foreach ($request->nascimento_dependente as $key => $nascimento_dependente) {
                $dependentArray[$key]['nascimento_dependente'] = $nascimento_dependente;
            }

            foreach ($request->filiacao_dependente as $key => $filiacao_dependente) {
                $dependentArray[$key]['filiacao_dependente'] = $filiacao_dependente;
            }

            foreach ($request->numero_unico_saude_dependente as $key => $numero_unico_saude_dependente) {
                $dependentArray[$key]['numero_unico_saude_dependente'] = $numero_unico_saude_dependente;
            }

            foreach ($request->numero_dn_dependente as $key => $numero_dn_dependente) {
                $dependentArray[$key]['numero_dn_dependente'] = $numero_dn_dependente;
            }

            foreach ($request->codigo_grupo_carencia_dependente as $key => $codigo_grupo_carencia_dependente) {
                $dependentArray[$key]['codigo_grupo_carencia_dependente'] = $codigo_grupo_carencia_dependente;
            }

            foreach ($request->codigo_grupo_carencia_odonto_dependente as $key => $codigo_grupo_carencia_odonto_dependente) {
                $dependentArray[$key]['codigo_grupo_carencia_odonto_dependente'] = $codigo_grupo_carencia_odonto_dependente;
            }

            foreach ($dependentArray as $key => $dependents) {
                $id = $propose::select('id')
                            ->where('email', $request->email)
                            ->first();

                $dependent =  new Dependent();

                $dependent->codigo_dependencia = $dependents['codigo_dependencia'];
                $dependent->nome_dependente = $dependents['nome_dependente'];
                $dependent->cpf_dependente = $dependents['cpf_dependente'];
                $dependent->sexo_dependente = $dependents['sexo_dependente'];
                $dependent->estado_civil_dependente = $dependents['estado_civil_dependente'];
                $dependent->nascimento_dependente = $dependents['nascimento_dependente'];
                $dependent->filiacao_dependente = $dependents['filiacao_dependente'];
                $dependent->numero_unico_saude_dependente = $dependents['numero_unico_saude_dependente'];
                $dependent->numero_dn_dependente = $dependents['numero_dn_dependente'];
                $dependent->codigo_grupo_carencia_dependente = $dependents['codigo_grupo_carencia_dependente'];
                $dependent->codigo_grupo_carencia_odonto_dependente = $dependents['codigo_grupo_carencia_odonto_dependente'];
                $dependent->fk_movimentacao_cadastral = $id->id;

                $dependent->save();
            }
        }

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
