<?php

namespace App\Updaters;

use App\Item;

class SulfrasItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item):void
    {
        return;
    }

    public function updateItemSellIn(Item $item): void
    {
        return;
    }

    public function updateItemQualityForExpiredItems($item): void
    {
        return;
    }
}