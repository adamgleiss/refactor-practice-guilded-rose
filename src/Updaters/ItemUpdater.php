<?php

namespace App\Updaters;

use App\Item;

class ItemUpdater
{
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    public function updateItemQuality(Item $item): void
    {
        $depreciation = $this->isExpired($item) ? 2 : 1;
        $item->quality = $item->quality - $depreciation;
        $this->applyQualityFloor($item);
    }

    public function updateItemSellIn(Item $item): void
    {
        $item->sell_in = $item->sell_in - 1;
    }

    protected function isExpired(Item $item)
    {
        return $item->sell_in < 0;
    }

    protected function applyQualityCap(Item $item)
    {
        if ($item->quality > self::MAX_QUALITY) {
            $item->quality = self::MAX_QUALITY;
        }
    }

    protected function applyQualityFloor(Item $item)
    {
        if ($item->quality < self::MIN_QUALITY) {
            $item->quality = self::MIN_QUALITY;
        }
    }
}