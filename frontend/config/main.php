<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [


        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],


        'request' => [
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            // тут инструкция https://github.com/codemix/yii2-localeurls
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['uk', 'ru'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableLanguageDetection' => false,
            'enableDefaultLanguageUrlCode' => false, //false не забудь в основном конфиге yii2   'language' => 'ru', чтобы язык явно не указывался
            'rules' => [
                'pages/<url:\w+>' => '/pages/view',
                'news/<url:\w+>' => '/news/view',

                //sitemap

                ['pattern' => '/sitemap.xml<page:\d+>', 'route' => 'sitemap/default/index'],
                ['pattern' => '/sitemap.xml', 'route' => 'sitemap/default/index'],

                // SEO старый сайт
                ['pattern' => '<category_id:45>', 'route' => '/shop?FilterForm[type]=12&FilterForm[shape]=0&FilterForm[color]=1&FilterForm[priceFrom]=0&FilterForm[priceTo]=157000&FilterForm[height]='],

            ],
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'gems_cart',
        ],
        'currency' => [
            'class' => 'common\components\Currency',
        ]
    ],
    'params' => $params,
];
