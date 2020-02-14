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
        // Get only parent components
        return Entity::withCount('children')
            ->where('parent_id', null)
            // id is necessary for eager loading
            ->latest()->get(['id', 'name', 'barcode', 'description']);
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

    /**
     * Display a listing of the entities.
     *
     * @param App\Entity $entity
     * @return \Illuminate\Http\Response
     */
    public function getChildren(Entity $entity)
    {
        return $entity->children()->withCount('children')->get();
    }
}
