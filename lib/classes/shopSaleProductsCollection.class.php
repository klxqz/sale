<?php

class shopSaleProductsCollection extends shopProductsCollection
{
    public function saleFilter()
    {
        if ($this->filtered) {
            return;
        }

        $this->where[] = 'p.compare_price > p.price';
        
        
        $this->filtered = true;
    }
    
}