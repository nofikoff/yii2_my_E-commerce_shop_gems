<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    // вверху страницы, если понадобится
    // public $jsOptions = ['position' => \yii\web\View::POS_HEAD];


    public $css = [  
        'css/style.css',
        'css/media.css',
        'css/colorbox.css',
        'css/owl.carousel.min.css',
        'css/font-awesome.min.css',
//        'css/site.css',
    ];
    public $js = [
        'js/modernizr.js',
        'js/jquery.colorbox-min.js',
        'js/jquery.selectbox-0.2.min.js',
        'js/jquery.carouFredSel-6.2.1-packed.js',
        'js/jquery.liTabs.js',
        'js/owl.carousel.min.js',
        'js/jquery-ui-1.10.1.min.js',
        'js/main.js',
        'js/plugins.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
