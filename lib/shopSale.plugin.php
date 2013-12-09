<?php

class shopSalePlugin extends shopPlugin {

    public function frontendNav() {
        if ($this->getSettings('default_output')) {
            return self::display();
        }
    }

    public static function display() {
        $plugin_id = array('shop', 'sale');
        $tmp_path = 'plugins/sale/templates/Sale.html';

        $app_settings_model = new waAppSettingsModel();
        $status = $app_settings_model->get($plugin_id, 'status');

        if (!$status) {
            return;
        }

        $count = $app_settings_model->get($plugin_id, 'count');

        $collection = new shopSaleProductsCollection();
        $collection->saleFilter(true);
        $products = $collection->getProducts('*', 0, $count);

        $view = wa()->getView();

        $view->assign('sale_products', $products);

        $template_path = wa()->getDataPath($tmp_path, false, 'shop', true);
        if (!file_exists($template_path)) {
            $template_path = wa()->getAppPath($tmp_path, 'shop');
        }

        $html = $view->fetch($template_path);
        return $html;
    }

}
