<?php

namespace App\Updaters;

use App\Item;

class ConjuredItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item): void
    {
        $depreciation = $this->isExpired($item) ? 4: 2;
        $item->quality = $item->quality - $depreciation;
        $this->applyQualityFloor($item);
    }
}