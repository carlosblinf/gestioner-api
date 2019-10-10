<?php

namespace App\Http\Controllers\Persona;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PersonaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        return $this->showAll($personas);
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
            'lastname' => 'required',
            'ci' => 'required|size:11',
            'address' => 'required',
            'gender' => 'required',
            'date_birth' => 'nullable|date',
            'email' => 'email|unique:personas',
            'member' => 'in:' . Persona::PERSONA_MEMBER . ',' . Persona::PERSONA_NO_MEMBER,
            'department_id' => 'required|Integer|min:1',
        ]);

        $persona = Persona::create($request->all());

        return $this->showOne($persona, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::findOrFail($id);
        return $this->showOne($persona);
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
        $persona = Persona::findOrFail($id);

        $this->validate($request, [
            'email' => 'email|unique:personas,email,' . $persona->id,
            'member' => 'in:' . Persona::PERSONA_MEMBER . ',' . Persona::PERSONA_NO_MEMBER,
            'department_id' => 'Integer|min:1',
        ]);

        if ($request->has('name')){
            $persona->name = $request->name;
        }
        if ($request->has('lastname')){
            $persona->lastname = $request->lastname;
        }
        if ($request->has('ci')){
            $persona->ci = $request->ci;
        }
        if ($request->has('address')){
            $persona->address = $request->address;
        }
        if ($request->has('gender')){
            $persona->gender = $request->gender;
        }
        if ($request->has('phone')){
            $persona->phone = $request->phone;
        }
        if ($request->has('celphone')){
            $persona->celphone = $request->celphone;
        }
        if ($request->has('email')){
            $persona->email = $request->email;
        }
        if ($request->has('civil_status')){
            $persona->civil_status = $request->civil_status;
        }
        if ($request->has('date_birth')){
            $persona->date_birth = $request->date_birth;
        }
        if ($request->has('ocupations')){
            $persona->ocupations = $request->ocupations;
        }
        if ($request->has('professions')){
            $persona->professions = $request->professions;
        }
        if ($request->has('desease')){
            $persona->desease = $request->desease;
        }
        if ($request->has('celula')){
            $persona->celula = $request->celula;
        }
        if ($request->has('member')){
            $persona->member = $request->member;
        }
        if ($request->has('department_id')){
            $persona->department_id = $request->department_id;
        }

        if (!$persona->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $persona->save();

        return $this->showOne($persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);

        $persona->delete();

        return $this->showOne($persona);
    }
}
