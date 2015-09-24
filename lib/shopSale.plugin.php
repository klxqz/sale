<?php

class shopSalePlugin extends shopPlugin {

    public static $plugin_id = array('shop', 'sale');
    public static $tmp_path = 'plugins/sale/templates/Sale.html';

    public function frontendNav() {
        if ($this->getSettings('default_output')) {
            return self::display();
        }
    }

    public static function products($count = null) {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(self::$plugin_id);

        $collection = new shopSaleProductsCollection();
        $collection->saleFilter(true);
        $products = $collection->getProducts('*', 0, $count);
        return $products;
    }

    public static function display() {
        $app_settings_model = new waAppSettingsModel();
        $status = $app_settings_model->get(self::$plugin_id, 'status');

        if (!$status) {
            return;
        }

        $count = $app_settings_model->get(self::$plugin_id, 'count');

        $collection = new shopSaleProductsCollection();
        $collection->saleFilter(true);
        $products = $collection->getProducts('*', 0, $count);

        $view = wa()->getView();

        $view->assign('sale_products', $products);

        $template_path = wa()->getDataPath(self::$tmp_path, false, 'shop', true);
        if (!file_exists($template_path)) {
            $template_path = wa()->getAppPath(self::$tmp_path, 'shop');
        }
        $html = $view->fetch($template_path);
        return $html;
    }

    public function routing($route = array()) {
        return array(
            $this->getSettings('page_url') => 'frontend/sale'
        );
    }

}
