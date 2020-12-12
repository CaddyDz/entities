<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntityRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'bail|required|string|max:100',
			// Make sure the submitted "parent_id" if any, exists in DB
			'parent_id' => 'nullable|integer|exists:entities,id',
			'barcode' => 'nullable|digits_between:10,100|unique:entities',
			'description' => 'bail|required|string|min:3|max:1000'
		];
	}
}
