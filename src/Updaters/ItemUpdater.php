<?php

namespace App\Updaters;

use App\Item;

class ItemUpdater
{
    public function updateItemQuality(Item $item)
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }

    public function updateItemSellIn(Item $item)
    {
        $item->sell_in = $item->sell_in - 1;
    }
}