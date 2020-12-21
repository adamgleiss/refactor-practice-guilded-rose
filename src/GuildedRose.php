<?php

namespace App;

use App\Updaters\AgedBrieItemUpdater;
use App\Updaters\BackstagePassItemUpdater;
use App\Updaters\ItemUpdater;
use App\Updaters\SulfrasItemUpdater;

final class GuildedRose
{

    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            $updater = $this->getUpdaterForItem($item);
            $updater->updateItemQuality($item);;
            $updater->updateItemSellIn($item);
            $this->updateItemQualityForExpiredItems($item);
        }
    }

    private function getUpdaterForItem(Item $item)
    {
        if ($item->name === 'Aged Brie') {
            return new AgedBrieItemUpdater();
        }

        if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            return new BackstagePassItemUpdater();
        }

        if ($item->name === 'Sulfuras, Hand of Ragnaros') {
            return new SulfrasItemUpdater();
        }

        return new ItemUpdater();
    }

    private function updateItemQualityForExpiredItems($item): void
    {
        if ($item->sell_in >= 0 || $this->isSulfuras($item)) {
            return;
        }

        if ($this->isAgedBrie($item)) {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }

            return;
        }

        if ($this->isBackstagePass($item)) {
            $item->quality = 0;

            return;
        }

        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }

    private function isAgedBrie(Item $item)
    {
        return $item->name === 'Aged Brie';
    }

    private function isBackstagePass(Item $item)
    {
        return $item->name === 'Backstage passes to a TAFKAL80ETC concert';
    }

    private function isSulfuras(Item $item)
    {
        return $item->name === 'Sulfuras, Hand of Ragnaros';
    }
}
