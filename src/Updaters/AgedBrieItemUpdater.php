<?php

namespace App\Updaters;

use App\Item;

class AgedBrieItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item): void
    {
        $appreciation = $this->isExpired($item) ? 2 : 1;
        $item->quality = $item->quality + $appreciation;
        $this->applyQualityCap($item);
    }
}