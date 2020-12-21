<?php

namespace App\Updaters;

use App\Item;

class BackstagePassItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
            if ($item->sell_in < 11) {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }
            if ($item->sell_in < 6) {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }
        }
    }

    public function updateItemQualityForExpiredItems($item): void
    {
        if ($item->sell_in >= 0) {
            return;
        }

        $item->quality = 0;
    }
}