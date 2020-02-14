<?php

namespace App\Observers;

use App\Entity;

class EntityObserver
{
    public function creating(Entity $entity)
    {
        if ($entity->barcode === null) { // If barcode is not defined by user
            $barcode = optional(Entity::latest()->first())->barcode; // Auto increment from the last one
            $entity->barcode = $barcode ? $barcode + 1 : 1;
        }
    }
}
