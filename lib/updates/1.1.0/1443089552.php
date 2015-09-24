<?php

$plugin_id = array('shop', 'sale');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'page_url', 'sale/');
$app_settings_model->set($plugin_id, 'meta_keywords', '');
$app_settings_model->set($plugin_id, 'meta_description', '');


