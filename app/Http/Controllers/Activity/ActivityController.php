<?php

namespace App\Http\Controllers\Activity;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ActivityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Activity::all();
        return $this->showAll($actividades);
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
            'dateStart' => 'required|date',
            'dateEnd' => 'date',
            'user_id' => 'Integer|min:1',
        ]);

        $actividad = Activity::create($request->all());

        return $this->showOne($actividad, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Activity::findOrFail($id);
        return $this->showOne($actividad);
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
        $actividad = Activity::findOrFail($id);

        $this->validate($request, [
            'name' => 'min:3',
            'description' => 'max:255',
            'dateStart' => 'date',
            'dateEnd' => 'date',
            'user_id' => 'Integer|min:1',
        ]);

        if ($request->has('name')){
            $actividad->name = $request->name;
        }
        if ($request->has('description')){
            $actividad->description = $request->description;
        }
        if ($request->has('dateStart')){
            $actividad->dateStart = $request->dateStart;
        }
        if ($request->has('dateEnd')){
            $actividad->dateEnd = $request->dateEnd;
        }
        if ($request->has('user_id')){
            $actividad->user_id = $request->user_id;
        }

         if (!$actividad->isDirty()){
            return $this->errorResponse('Debe especificar al menos un valor diferente para cambiar', 422);
        }

        $actividad->save();

        return $this->showOne($actividad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Activity::findOrFail($id);

        $actividad->delete();

        return $this->showOne($actividad);
    }
}
