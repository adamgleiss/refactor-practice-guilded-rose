<?php

namespace App;

use App\Updaters\AgedBrieItemUpdater;
use App\Updaters\BackstagePassItemUpdater;
use App\Updaters\ConjuredItemUpdater;
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
            $updater->updateItemSellIn($item);
            $updater->updateItemQuality($item);
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

        if ($item->name === 'Conjured') {
            return new ConjuredItemUpdater();
        }

        return new ItemUpdater();
    }
}
