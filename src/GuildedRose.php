<?php

namespace App;

final class GuildedRose {

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            $this->updateItemQuality($item);
            $this->updateSellInDate($item);
            $this->updateItemQualityForExpiredItems($item);
        }
    }

    private function updateItemQuality($item): void
    {
        if (!$this->isAgedBrie($item) and !$this->isBackstagePass($item)) {
            if ($item->quality > 0) {
                if (!$this->isSulfuras($item)) {
                    $item->quality = $item->quality - 1;
                }
            }
        } else {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
                if ($this->isBackstagePass($item)) {
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
        }
    }

    private function updateSellInDate($item): void
    {
        if($this->isSulfuras($item)) {
            return;
        }

        $item->sell_in = $item->sell_in - 1;
    }

    private function updateItemQualityForExpiredItems($item): void
    {
        if ($item->sell_in >= 0) {
            return;
        }

        if (!$this->isAgedBrie($item)) {
            if (!$this->isBackstagePass($item)) {
                if ($item->quality > 0) {
                    if (!$this->isSulfuras($item)) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                $item->quality = $item->quality - $item->quality;
            }
        } else {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
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
