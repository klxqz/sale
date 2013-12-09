<?php

return array(
    'name' => 'Растродажа',
    'description' => 'Отдельная страница из товаров, у которые есть зачеркнутая цена',
    'vendor' => '985310',
    'version' => '1.0.2',
    'img' => 'img/sale.png',
    'shop_settings' => true,
    'frontend' => true,
    'icons' => array(
        16 => 'img/sale.png',
    ),
    'handlers' => array(
        'frontend_nav' => 'frontendNav',
    ),
);
//EOF
