<?php

class shopSalePluginBackendSaveController extends waJsonController {

    public function execute() {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_sale = waRequest::post('shop_sale');
            foreach ($shop_sale as $key => $value) {
                $app_settings_model->set(shopSalePlugin::$plugin_id, $key, $value);
            }

            if (isset($shop_novelties['reset_tpl']) && $shop_novelties['reset_tpl']) {
                $template_path = wa()->getDataPath(shopSalePlugin::$tmp_path, false, 'shop', true);
                @unlink($template_path);
            } else {
                $post_template = waRequest::post('template');
                if (!$post_template) {
                    throw new waException('Не определён шаблон');
                }

                $template_path = wa()->getDataPath(shopSalePlugin::$tmp_path, false, 'shop', true);
                if (!file_exists($template_path)) {
                    $template_path = wa()->getAppPath(shopSalePlugin::$tmp_path, 'shop');
                }

                $template = file_get_contents($template_path);
                if ($template != $post_template) {
                    $template_path = wa()->getDataPath(shopSalePlugin::$tmp_path, false, 'shop', true);

                    $f = fopen($template_path, 'w');
                    if (!$f) {
                        throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись ' . $template_path);
                    }
                    fwrite($f, $post_template);
                    fclose($f);
                }
            }

            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
