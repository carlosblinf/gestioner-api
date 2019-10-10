<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
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
        $reglas = [
            'name' => 'required',
            'nickname' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
        
        $this->validate($request, $reglas);

        $campos = $request->all();
        $campos['password'] = hash('sha256',$request->password);
        $campos['admin'] = User::REGULAR_USER;
        $campos['actived'] = User::USER_NOT_ACTIVED;

        $usuario = User::create($campos);

        return $this->showOne($usuarios, 201);
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
        $reglas = [
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
            'actived' => 'in:' . User::USER_ACTIVED . ',' . User::USER_NOT_ACTIVED,
        ];

        $this->validate($request, $reglas);

        if ($request->has('name')){
            $usuario->name = $request->name;
        }
        if ($request->has('password')){
            $usuario->password = hash('sha256',$request->password);
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