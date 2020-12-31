<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entity;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\DeleteEntityRequest;
use Illuminate\Http\Request;

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
		$entity->{"children_count"} = 0;
		return response([
			'status' => 'success',
			'entity' => $entity
		], 201);
	}

	/**
	 * Remove entity from storage.
	 *
	 * @param  \App\Http\Requests\DeleteEntityRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function delete(DeleteEntityRequest $request)
	{
		Entity::destroy($request->id);
		Entity::where('parent_id', $request->id)->delete();
		return response([
			'status' => 'success',
			'message' => 'entity successfully deleted'
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

	public function getLastBarCode()
	{
		return Entity::max('barcode') + 1;
	}
}
