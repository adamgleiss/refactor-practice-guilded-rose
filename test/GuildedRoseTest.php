<?php

namespace App;

use PHPUnit\Framework\TestCase;

class GuildedRoseTest extends TestCase {
    public function testFoo() {
        $items      = [new Item("fixme", 0, 0)];
        $gildedRose = new GuildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->name);
    }
}