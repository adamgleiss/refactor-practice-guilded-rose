<?php

namespace App\Updaters;

use App\Item;

class ItemUpdater
{
    public function updateItemQuality(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }

    public function updateItemSellIn(Item $item): void
    {
        $item->sell_in = $item->sell_in - 1;
    }

    public function updateItemQualityForExpiredItems($item): void
    {
        if ($item->sell_in < 0 && $item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}