<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Item;
use App\GuildedRose;

class GuildedRoseTest extends TestCase
{
    public function testNormalItemNotPastDate()
    {
        $item = new Item("item", 4, 2);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("item, 3, 1", (string)$item);
    }

    public function testNormalItemPastDate()
    {
        $item = new Item("item", -2, 4);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("item, -3, 2", (string)$item);
    }

    public function testNegativeQuality()
    {
        $item = new Item("item", -2, 0);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("item, -3, 0", (string)$item);
    }

    public function testAgedBrieIncreasedQualityPastSellInDate()
    {
        $item = new Item("Aged Brie", -2, 3);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie, -3, 5", (string)$item);
    }

    public function testAgedBrieIncreasedQualityNotPastSellInDate()
    {
        $item = new Item("Aged Brie", 2, 3);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie, 1, 4", (string)$item);
    }

    public function testMaxQuality()
    {
        $item = new Item("Aged Brie", 10, 50);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Aged Brie, 9, 50", (string)$item);
    }

    public function testSulfras()
    {
        $item = new Item("Sulfuras, Hand of Ragnaros", 7, 80);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Sulfuras, Hand of Ragnaros, 7, 80", (string)$item);
    }

    public function testBackStagePassesThreeWeeksOut()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 21, 10);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert, 20, 11", (string)$item);
    }

    public function testBackStagePassesTenDaysOut()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert, 9, 12", (string)$item);
    }

    public function testBackStagePassesThreeDaysOut()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 3, 10);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert, 2, 13", (string)$item);
    }

    public function testBackStagePassesAfterShow()
    {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", 0, 10);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert, -1, 0", (string)$item);
    }

    public function testItemMix()
    {
        $items = [
            new Item("Backstage passes to a TAFKAL80ETC concert", 3, 10),
            new Item("Sulfuras, Hand of Ragnaros", 7, 80),
            new Item("item", -2, 4)
        ];
        $gildedRose = new GuildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("Backstage passes to a TAFKAL80ETC concert, 2, 13", (string)$items[0]);
        $this->assertEquals("Sulfuras, Hand of Ragnaros, 7, 80", (string)$items[1]);
        $this->assertEquals("item, -3, 2", (string)$items[2]);
    }

    public function testConjuredItem()
    {
        $item = new Item("Conjured", 3, 4);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Conjured, 2, 2", (string)$item);
    }

    public function testExpiredConjuredItem()
    {
        $item = new Item("Conjured", -2, 8);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Conjured, -3, 4", (string)$item);
    }

    public function testExpiredConjuredItemMinQuality()
    {
        $item = new Item("Conjured", -2, 3);
        $gildedRose = new GuildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals("Conjured, -3, 0", (string)$item);
    }
}