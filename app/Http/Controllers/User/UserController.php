<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return $this->showAll($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nickname' => 'required|min:3|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $campos = $request->all();
        $campos['password'] = bcrypt($request->password);
        $campos['admin'] = User::REGULAR_USER;
        $campos['actived'] = User::USER_NOT_ACTIVED;

        $usuario = User::create($campos);

        return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return $this->showOne($usuario);
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
        $usuario = User::findOrFail($id);   

        $this->validate($request, [
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
            'actived' => 'in:' . User::USER_ACTIVED . ',' . User::USER_NOT_ACTIVED,
        ]);

        if ($request->has('name')){
            $usuario->name = $request->name;
        }
        if ($request->has('password')){
            if (!Hash::check($request->password, $usuario->getAuthPassword())) {
                $usuario->password = bcrypt($request->password);
            }
        }
        if ($request->has('actived')){
            $usuario->actived = $request->actived;
        }
        if ($request->has('admin')){
            if (!$usuario->isActived()){
                return $this->errorResponse('Un usuario solo puede ser administrador si ya ha sido activado', 409);
            }
            $usuario->admin = $request->admin;
        }
        
        if (!$usuario->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $usuario->save();

        return $this->showOne($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->delete();

        return $this->showOne($usuario);
    }
}
