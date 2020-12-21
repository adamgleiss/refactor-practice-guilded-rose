<?php

namespace App\Updaters;

use App\Item;

class AgedBrieItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item)
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }
}