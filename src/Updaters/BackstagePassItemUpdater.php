<?php

namespace App\Updaters;

use App\Item;

class BackstagePassItemUpdater extends ItemUpdater
{
    public function updateItemQuality(Item $item): void
    {
        if ($this->isExpired($item)) {
            $item->quality = 0;
            return;
        }

        $item->quality = $item->quality += $this->determineAppreciation($item);
        $this->applyQualityCap($item);

    }

    private function determineAppreciation(Item $item)
    {
        $appreiation = 1;
        if ($item->sell_in < 11) {
            $appreiation++;
        }
        if ($item->sell_in < 6) {
            $appreiation++;
        }

        return $appreiation;
    }
}