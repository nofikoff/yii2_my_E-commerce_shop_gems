<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'id' => 'app-frontend',
    'name'=>'Gems.ua',

    /**
     * ВНИМАНИЕ! Если вздумаешь переключить на другой язык
     * учти что надо поправить карту сайта и robots.txt
     * кажда страница имеет ТРИ варианта URL
     * напрмимер
     * https://gems.ua/pages/about - это для языка выставленного по дефлот здесь
     * https://gems.ua/ru/pages/about
     * https://gems.ua/uk/pages/about
     * чтобы избежать дубирования контента - одну из версий страницы надо заблокировать к индексации и не указывать в sutemap.xml
     */

    'language' => 'uk',
];

