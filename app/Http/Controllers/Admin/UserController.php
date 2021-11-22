<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        return view('usuario.cadastro', [
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

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find($id)->first();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);

        if ($request->file('profile_photo')) {
            $userPath = Str::slug($user->name);
            $nameProfile = $request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('public/' . $userPath . '/profile', $nameProfile);

            $user->profile_photo = 'storage/' . $userPath . '\\profile\\' . $nameProfile ;
        }

        if ($validator->fails()) {
            return redirect()->route('admin.user')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->save();

        return redirect()->route('admin.user')->with('message', 'Perfil atualizado com sucesso!');
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
