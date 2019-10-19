<?php

namespace App\Http\Controllers\Structure;

use App\Structure;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class StructureController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estructuras = Structure::all();
        return $this->showAll($estructuras);
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

        $estructura = Structure::create($request->all());

        return $this->showOne($estructura, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estructura = Structure::findOrFail($id);
        return $this->showOne($estructura);
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
        $estructura = Structure::findOrFail($id);

        $this->validate($request, [
            'name' => 'min:3',
            'description' => 'max:255',
            'chief' => 'Integer|min:1',
        ]);

        if ($request->has('name')){
            $estructura->name = $request->name;
        }
        if ($request->has('description')){
            $estructura->description = $request->description;
        }
        if ($request->has('chief')){
            $estructura->chief = $request->chief;
        }

         if (!$estructura->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $estructura->save();

        return $this->showOne($estructura);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estructura = Structure::findOrFail($id);

        $estructura->delete();

        return $this->showOne($estructura);
    }
}
