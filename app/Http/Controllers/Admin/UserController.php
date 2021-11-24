<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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
            'user' => $user->name,
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
            'user' => $user->name,
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
        $user->password = bcrypt($request->password);

        if ($request->file('profile_photo')) {
            $userPath = Str::slug($user->name);
            $nameProfile = $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('public/' . $userPath . '/profile', $nameProfile);

            $user->profile_photo = 'storage/' . $userPath . '\\profile\\' . $nameProfile;
        }

        $user->save();

        return redirect()->route('admin.user')->with('Usuário criado com sucesso!');
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
    public function update(UserRequest $request, $id)
    {

        $user = User::find($id)->first();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);

        if ($request->file('profile_photo')) {
            $userPath = Str::slug($user->name);
            $nameProfile = $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('public/' . $userPath . '/profile', $nameProfile);

            $user->profile_photo = 'storage/' . $userPath . '\\profile\\' . $nameProfile ;
        }

        $user->save();

        return redirect()->route('admin.user')->with('Atualizado com sucesso!');
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
