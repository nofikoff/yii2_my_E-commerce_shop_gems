<?php
namespace frontend\controllers;

//use yii\base\Exception;

use himiklab\sitemap\Sitemap as BaseSitemapController;
use yii\db\Query;

class SitemapController extends BaseSitemapController

{



    static function getSMpages()
    {
        $leadsCount = (new Query())
            ->from('my_profile_all')
            ->Andwhere('disabled_profile = 0')
            ->count();
        return round((int)$leadsCount / 50000) + 1;
    }

    public function buildSitemap()
    {


        $urls = [];
        // перебираем модели и з конфига
        //  'modules' => 'sitemap'
        foreach ($this->models as $modelName) {
            if (is_array($modelName)) {
                $model = new $modelName['class'];
                if (isset($modelName['behaviors'])) {
                    $model->attachBehaviors($modelName['behaviors']);
                }
            } else {
                $model = new $modelName;
            }

            $urls = array_merge($urls, $model->generateSiteMap());
        }

        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php
        //The view file does not exist: /home/camcollector/public_html/frontend/controllers/views/default/index.php


        if (isset($_GET['page'])) {
            $sitemapData = $this->createControllerByID('default')->renderPartial('submap', [
                'urls' => $urls
            ]);
        } else {
            $sitemapData = $this->createControllerByID('default')->renderPartial('index', [
                'urls' => $urls
            ]);
        }
        $this->cacheProvider->set($this->cacheKey, $sitemapData, $this->cacheExpire);
        return $sitemapData;
    }

    // потеряшка - укажем где его вьюшки хранятьсчя
    public function getViewPath()
    {
        return \Yii::getAlias('@frontend/views/sitemap');
    }
}

