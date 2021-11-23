<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Propose;
use App\Dependent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProposeRequest;
use App\Http\Requests\UpdateProposeRequest;

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
        $user = Auth::user();
        $entities = DB::table('administradora')
                        ->join('users', 'users.fk_administradora', '=', 'administradora.id')
                        ->join('entidade', 'entidade.fk_administradora', '=', 'administradora.id')
                        ->join('vigencia', 'vigencia.id', '=', 'entidade.fk_vigencia')
                        ->select('entidade.contrato', 'entidade.nome_entidade', 'vigencia.data')
                        ->orderBy('entidade.nome_entidade')
                        ->orderBy('vigencia.data')
                        ->get();

        return view('administradora.cadastrar-proposta', [
            'user' => $user->name,
            'users' => $user,
            'entities' => $entities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProposeRequest $request)
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

        return view('administradora.ver-propostas', [
            'user' => $user->name,
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

        return view('administradora.editar-proposta', [
            'user' => $user->name,
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
    public function update(UpdateProposeRequest $request, $id)
    {

        $propose = Propose::where('id', $id)->first();
        $propose->fill($request->all());
        $propose->setDataInclusaoAttribute($request->data_inclusao);
        $propose->setDataExclusaoAttribute($request->data_exclusao);
        $propose->setNascimentoAttribute($request->nascimento);
        $propose->setFkStatusAttribute(2);

        if ($request->codigo_dependencia){

            foreach ($request->id_dependente as $key => $id_dependente) {
                $dependentArray[$key]['id_dependente'] = $id_dependente;
            }

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

                $dependent = Dependent::where('id', $dependents['id_dependente'])->first();

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

                $dependent->save();
            }

        }

        $propose->save();

        return redirect('dashboard')->with('message', 'Cadastrado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propose = Propose::find($id);

        $propose->update(['fk_status' => 7]);
        $propose->delete();

        return redirect('dashboard')->with('message', 'Proposta deletada com sucesso!');
    }

    public function destroyDependent(Request $request)
    {
        $dependent = Dependent::find($request->id);

        $dependent->delete();

        $return['message'] = "O {$dependent->nome_dependente}, foi deletado com sucesso!";

        echo json_encode($return);
        return;
    }

    public function dashboard()
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
}
