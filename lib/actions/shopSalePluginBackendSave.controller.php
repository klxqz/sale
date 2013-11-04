<?php

class shopSalePluginBackendSaveController extends waJsonController {

    protected $tmp_path = 'plugins/sale/templates/Sale.html';
    protected $plugin_id = array('shop', 'sale');
    
    public function execute()
    {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_sale = waRequest::post('shop_sale');
            
            $app_settings_model->set($this->plugin_id, 'status', (int) $shop_sale['status']);
            $app_settings_model->set($this->plugin_id, 'default_output', (int) $shop_sale['default_output']);
            $app_settings_model->set($this->plugin_id, 'count', (int) $shop_sale['count']);
            $app_settings_model->set($this->plugin_id, 'page_title', $shop_sale['page_title']);
            
            
            if(isset($shop_sale['reset_tpl']) &&  $shop_sale['reset_tpl']) {
                $template_path =wa()->getDataPath($this->tmp_path, false, 'shop', true);
                @unlink($template_path);
            } else {
                $post_template = waRequest::post('template');
                if(!$post_template) {
                    throw new waException('Не определён шаблон');
                } 
                
                $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
                if(!file_exists($template_path)) {
                    $template_path = wa()->getAppPath($this->tmp_path, 'shop');
                }
                
                $template = file_get_contents($template_path);
                if($template != $post_template) {
                    $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
                    
                    $f = fopen($template_path, 'w');
                    if(!$f) {
                        throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись '.$template_path);
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