<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Http\Requests\StoreEntityRequest;

class EntitiesController extends Controller
{
    /**
     * Display a listing of the entities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Entity::where('parent_id', null)->get();
    }

    /**
     * Store a newly created entity in storage.
     *
     * @param  \App\Http\Requests\StoreEntityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntityRequest $request)
    {
        $entity = Entity::create($request->all());
        return response([
            'status' => 'success',
            'entity' => $entity
        ], 201);
    }
}
