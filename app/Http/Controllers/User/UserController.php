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
    public function show(User $user)
    {
        // $usuario = User::findOrFail($id);
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
            'actived' => 'in:' . User::USER_ACTIVED . ',' . User::USER_NOT_ACTIVED,
        ]);

        if ($request->has('name')){
            $user->name = $request->name;
        }
        if ($request->has('password')){
            if (!Hash::check($request->password, $user->getAuthPassword())) {
                $user->password = bcrypt($request->password);
            }
        }
        if ($request->has('actived')){
            $user->actived = $request->actived;
        }
        if ($request->has('admin')){
            if (!$user->isActived()){
                return $this->errorResponse('Un usuario solo puede ser administrador si ya ha sido activado', 409);
            }
            $user->admin = $request->admin;
        }
        
        if (!$user->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $user->save();

        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->showOne($user);
    }
}
