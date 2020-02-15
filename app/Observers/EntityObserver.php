<?php

namespace App\Observers;

use App\Entity;

class EntityObserver
{
    public function creating(Entity $entity)
    {
        if ($entity->barcode === null) { // If barcode is not defined by user
            $barcode = Entity::max('barcode') ?? 0; // Auto increment from the max one
            $entity->barcode = $barcode ? $barcode + 1 : 1;
        }
    }
}
