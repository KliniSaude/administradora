<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $administrator = DB::table('users')
                            ->join('administradora', 'users.fk_administradora', '=', 'administradora.id')
                            ->select('administradora.nome_empresa')
                            ->first();

        return view('usuario.edit', [
            'user' => $user,
            'users' => $user,
            'administrator' => $administrator
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $administrators = DB::table('administradora')
                            ->select('id', 'nome_empresa', 'cnpj')
                            ->get();

        return view('usuario.create', [
            'user' => $user,
            'users' => $user,
            'administrators' => $administrators
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->setStatusAttribute($request->status);
        $user->password = bcrypt($request->password);

        if ($request->file('profile_photo')) {
            $userPath = Str::slug($user->name);
            $nameProfile = $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('public/' . $userPath . '/profile', $nameProfile);

            $user->profile_photo = 'storage/' . $userPath . '\\profile\\' . $nameProfile;
        }

        $user->save();

        return redirect()->route('operadora.users.all')->with('message', 'Usuário criado com sucesso!');
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
        $user = Auth::user();

        $users = User::find($id);
        $administrators = DB::table('administradora')
                            ->select('id', 'nome_empresa', 'cnpj')
                            ->get();

        return view('usuario.editUser', [
            'user' => $user,
            'users' => $users,
            'administrators' => $administrators
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = User::find($id);

        $user->fill($request->all());
        $user->setStatusAttribute($request->status);
        $user->password = bcrypt($request->password);

        if ($request->file('profile_photo')) {
            $userPath = Str::slug($user->name);
            $nameProfile = $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('public/' . $userPath . '/profile', $nameProfile);

            $user->profile_photo = 'storage/' . $userPath . '\\profile\\' . $nameProfile ;
        }

        $user->save();

        return redirect()->route('operadora.users.all')->with('message', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('operadora.users.all')->with('message', 'Usuário excluido com sucesso!');
    }

    public function allUsers()
    {
        $user = Auth::user();
        $administrators = DB::table('administradora')
                            ->select('id', 'nome_empresa', 'cnpj')
                            ->get();

        $usersAdministrators = DB::table('users')
                                ->join('administradora', 'administradora.id', '=', 'users.fk_administradora')
                                ->where('users.user_type', 0)
                                ->whereNull('deleted_at')
                                ->select('users.id', 'users.name', 'users.email', 'users.status', 'administradora.nome_empresa')
                                ->paginate(15);

        return view('usuario.users', [
            'user' => $user,
            'users' => $user,
            'administrators' => $administrators,
            'usersAdministrators' => $usersAdministrators
        ]);
    }
}
