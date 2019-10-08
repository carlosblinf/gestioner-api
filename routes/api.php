<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
* Personas
*/
Route::resource('personas', 'Persona\PersonaController', ['except'=>['create','edit']]);
/**
* Departments
*/
Route::resource('departments', 'Department\DepartmentController', ['except'=>['create','edit']]);
/**
* Structures
*/
Route::resource('structures', 'Structure\StructureController', ['except'=>['create','edit']]);
/**
* Activities
*/
Route::resource('activities', 'Activity\ActivityController', ['except'=>['create','edit']]);
/**
* Users
*/
Route::resource('users', 'User\UserController', ['except'=>['create','edit']]);
