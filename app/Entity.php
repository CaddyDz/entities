<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property int $barcode
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity[] $children
 * @property-read int|null $children_count
 * @property-read \App\Entity|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entity extends Model
{
	protected $fillable = [
		'name', 'barcode', 'description', 'parent_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = ['created_at', 'updated_at'];

	/**
	 * Get the parent entity that owns the child entity.
	 */
	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	/**
	 * Get the child entities that belongs to this entity.
	 */
	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}
}
