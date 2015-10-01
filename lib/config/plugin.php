<?php

return array(
    'name' => 'Распродажа',
    'description' => 'Отдельная страница из товаров, у которые есть зачеркнутая цена',
    'vendor' => '985310',
    'version' => '1.1.1',
    'img' => 'img/sale.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'frontend_nav' => 'frontendNav',
    ),
);
//EOF
