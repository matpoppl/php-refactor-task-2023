<?php

namespace App;

final class GildedRose
{
    public function updateAged(Item $item) : void
    {
        if ($item->sell_in < 1) {
            $item->quality = $item->quality + 2;
        } else {
            $item->quality = $item->quality + 1;
        }
        
        $item->sell_in = $item->sell_in - 1;
        
        $item->quality = min(50, $item->quality);
    }
    
    public function updateBackstage(Item $item) : void
    {
        if ($item->sell_in < 1) {
            $item->quality = 0;
        } else if ($item->sell_in < 6) {
            $item->quality = $item->quality + 3;
        } else if ($item->sell_in < 11) {
            $item->quality = $item->quality + 2;
        } else {
            $item->quality = $item->quality + 1;
        }
        
        $item->sell_in = $item->sell_in - 1;
        
        $item->quality = min(50, $item->quality);
    }
    
    public function updateQuality(Item $item) : void
    {
        switch ($item->name) {
            case 'Sulfuras, Hand of Ragnaros':
                // do nothing
                return;
            case 'Aged Brie':
                $this->updateAged($item);
                return;
            case 'Backstage passes to a TAFKAL80ETC concert':
                $this->updateBackstage($item);
                return;
        }
        
        $item->quality = max(0, $item->quality - 1);
        
        $item->sell_in = $item->sell_in - 1;

        if ($item->sell_in < 0) {
            if ($item->quality > 0) {
                $item->quality = $item->quality - 1;
            }
        }
    }
}
