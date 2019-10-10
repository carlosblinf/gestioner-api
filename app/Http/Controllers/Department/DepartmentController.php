<?php

namespace App\Http\Controllers\Department;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DepartmentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Department::all();
        return $this->showAll($departamentos);
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
            'name' => 'required|min:3',
            'description' => 'nullable|max:255',
            'chief' => 'Integer|min:1',
        ]);

        $departamento = Department::create($request->all());

        return $this->showOne($departamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Department::findOrFail($id);
        return $this->showOne($departamento);
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
        $departamento = Department::findOrFail($id);

        $this->validate($request, [
            'name' => 'min:3',
            'description' => 'max:255',
            'chief' => 'Integer|min:1',
        ]);

        if ($request->has('name')){
            $departamento->name = $request->name;
        }
        if ($request->has('description')){
            $departamento->description = $request->description;
        }
        if ($request->has('chief')){
            $departamento->chief = $request->chief;
        }

         if (!$departamento->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $departamento->save();

        return $this->showOne($departamento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departamento = Department::findOrFail($id);

        $departamento->delete();

        return $this->showOne($departamento);
    }
}
