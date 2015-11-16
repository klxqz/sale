<?php

class shopSaleProductsCollection extends shopProductsCollection {

    public function saleFilter($rand = false) {
        if ($this->filtered) {
            return;
        }
        $routing = wa()->getRouting();
        $route = $routing->getRoute();
        $this->where[] = 'p.compare_price > p.price';
        $this->where[] = 'p.status != 0';
        if (!empty($route['type_id'])) {
            $this->where[] = "`p`.`type_id` IN (" . implode(',', $route['type_id']) . ")";
        }

        if ($rand) {
            $this->order_by = "RAND()";
        }

        $this->prepared = true;
        $this->filtered = true;
    }

}
