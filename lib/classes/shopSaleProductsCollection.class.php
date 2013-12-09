<?php

class shopSaleProductsCollection extends shopProductsCollection {

    public function saleFilter($rand = false) {
        if ($this->filtered) {
            return;
        }

        $this->where[] = 'p.compare_price > p.price';

        if ($rand) {
            $this->order_by = "RAND()";
        }

        $this->prepared = true;
        $this->filtered = true;
    }

}
