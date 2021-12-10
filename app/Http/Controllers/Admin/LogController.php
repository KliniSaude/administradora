<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $logs = DB::table('log')
                    ->join('users', 'log.fk_user', '=', 'users.id')
                    ->join('movimentacao_cadastral', 'log.fk_movimentacao', '=', 'movimentacao_cadastral.id')
                    ->join('status', 'log.fk_status', '=', 'status.id')
                    ->join('entidade', 'movimentacao_cadastral.fk_contrato', '=', 'entidade.id')
                    ->join('vigencia', 'vigencia.id', '=', 'entidade.fk_vigencia')
                    ->join('administradora', 'administradora.id', '=', 'entidade.fk_administradora')
                    ->select('log.id', 'movimentacao_cadastral.data_inclusao', 'movimentacao_cadastral.data_exclusao',
                    'entidade.nome_entidade', 'users.name', 'status.status', 'administradora.nome_empresa', 'vigencia.data', 'log.timestamp')
                    ->paginate(10);

        return view('log.log', [
            'users' => $user,
            'user' => $user,
            'logs' => $logs
        ]);
    }
}
