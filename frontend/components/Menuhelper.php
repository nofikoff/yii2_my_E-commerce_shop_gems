<?php

namespace frontend\components;

use common\models\ProductsColorGroup;
use common\models\ProductsShapes;
use common\models\ProductType;
use Yii;
use yii\db\Query;

class Menuhelper
{
    /*
        public static function getRelatedListModels($id)
        {

    //        $group_tags = [
    //            '3' => 'age',
    //            '5' => 'bust',
    //            '9' => 'couple_or_group',
    //            '8' => 'extra',
    //            '11' => 'eye_color',
    //            '7' => 'figure',
    //            '4' => 'hair_color',
    //            '10' => 'hair_length',
    //            '12' => 'penis_size',
    //            '6' => 'pubic_area',
    //            '2' => 'race',
    //            '1' => 'sex',
    //        ];

            $max = 8;

            //био профайла кэшируем на месяц
            // ВАЖНО ТУТ ПО ВСЕЙ БАЗЕ ИБО 404 ГУгл будет давать де тех кто не онлайн
            $model = ProfileAll::getDb()->cache(function ($db) use ($id) {
                return ProfileAll::findOne($id);
            }, Yii::$app->params['cache_profile_bio']);
    //        $model = Profile::findOne($id);


            $queryParams["tag"]["sex"] = [];
            // набираем тэги для запроса
            foreach ($model->tags as $t) {
                // исключим кое какие параметры второстепенные
                if (in_array($t->grouptag_id, [8, 11, 4, 10, 6])) continue;
                $queryParams["tag"]["sex"][] = $t->id_tag;
            }


            // список рекомендованных анкет, кэшируем на 2 часа, ибо важны свежие!!!
            $a = Yii::$app->db->cache(function ($db) use ($queryParams, $max, $id) {
                $searchModel = new \frontend\models\Profile_Search();
                $dataProvider = $searchModel->search($queryParams);
                $dataProvider->pagination->pageSize = $max + 1;
                $dataProvider->setSort(['defaultOrder' => [
                    'rateparam_03' => SORT_DESC,
                    'rateparam_01' => SORT_DESC,
                    'count_onlinenow_sec' => SORT_ASC,
                ]]);
                $a = '';
                foreach ($dataProvider->models as $m) {
                    if ($m->id_profile == $id) continue;
                    $a .= '
                    <div class="static-image">
                        <a href="/profile/view?id=' . $m->id_profile . '">
                            <img src="' . Profile::https_replace_kostyl($m) . '" alt="' . $m->nickname_profile . ' live sexchat picture" class="img-responsive">
                        </a>
                    </div>
                ';
                }
                return $a;
            }, Yii::$app->params['cache_profile_sidebar_thesamemodels_onlinenow']);


            $found_models = 0;
            if (preg_match_all('~static-image~', $a, $d)) {
                //echo "******NEXT*******";
                $found_models = sizeof($d[0]);
            }
            // слишком жестокие условия поиска похожей модели - поищем по мягчем добавм на сайдбр
            // слишком жестокие условия поиска похожей модели - поищем по мягчем добавм на сайдбр
            // слишком жестокие условия поиска похожей модели - поищем по мягчем добавм на сайдбр
            // слишком жестокие условия поиска похожей модели - поищем по мягчем добавм на сайдбр
            if ($found_models < ($max)) {

                $a .= Yii::$app->db->cache(function ($db) use ($queryParams, $max, $id, $model, $found_models) {
                    //$model = Profile::findOne($id);
                    $queryParams["tag"]["sex"] = [];
                    // набираем тэги для запроса
                    foreach ($model->tags as $t) {
                        // исключим кое какие параметры второстепенные
                        if (in_array($t->grouptag_id, [3, 5, 9, 8, 11, 7, 4, 10, 12, 6])) continue;

                        $queryParams["tag"]["sex"][] = $t->id_tag;
                    }
                    $searchModel = new \frontend\models\Profile_Search();
                    $dataProvider2 = $searchModel->search($queryParams);
    //            $dataProvider2->pagination->pageSize = $max - sizeof($dataProvider->models) + 1;
                    $dataProvider2->pagination->pageSize = $max - $found_models;
                    $dataProvider2->setSort(['defaultOrder' => [
                        'rateparam_03' => SORT_DESC,
                        'rateparam_01' => SORT_DESC,
                        'count_onlinenow_sec' => SORT_ASC,
                    ]]);
                    $a = '';
                    foreach ($dataProvider2->models as $m) {
                        if ($m->id_profile == $id) continue;
                        $a .= '
                    <div class="static-image">
                        <a href="/profile/view?id=' . $m->id_profile . '">
                            <img src="' . Profile::https_replace_kostyl($m) . '" alt="' . $m->nickname_profile . ' live sexchat picture" class="img-responsive">
                        </a>
                    </div>

                ';
                    }
                    return $a;
                }, Yii::$app->params['cache_profile_sidebar_thesamemodels_onlinenow']);
            }

            echo $a;
            if ($a) echo '<center><a href="/related-webcam-models/' . $id . '" class="btn"
                                       alt="ALL RELATED WEBCAMS ONLINE NOW">All related webcam models</a></center>';

        }*/

    /*
        public static function getCountModelOnline()
        {


            $leadsCount = Yii::$app->db->cache(function ($db) {
                return (new Query())
                    ->from('my_profile')
                    ->where('onlinenow_profile = 1')
                    ->Andwhere('disabled_profile = 0')
                    ->count();
            }, Yii::$app->params['cache_header_number_models_online_now']);

    //        $leadsCount = (new Query())
    //            ->from('my_profile')
    //            ->where('onlinenow_profile = 1')
    //            ->Andwhere('disabled_profile = 0')
    //            ->count();


            return number_format((int)$leadsCount, 0, '.', ',');


        }*/

    /* public static function getCountTotalModels()
    {
     $leadsCount = (new Query())
         ->from('my_profile')
         // почему без онлайн моделей?
         //->where('onlinenow_profile = 1')
         ->Andwhere('disabled_profile = 0')
         ->count();
     return number_format((int)$leadsCount, 0, '.', ',');
    }*/

    public static function getMenuListGems()
    {
        //id_product_type
        $list = ProductType::find()->where("`status_disabled` = 0")->orderby('name_product_type'.(Yii::$app->language=='uk'?'_ua':''))->all();
        $a = '';
        foreach ($list as $product) {
            $a .= "<li><a href='/shop?FilterForm%5Btype%5D=".$product->id_product_type."'>".$product->{'name_product_type'.(Yii::$app->language=='uk'?'_ua':'')}."</a></li>\n";
        }
        return $a;
    }

 public static function getMenuListColors()
    {
        //id_product_type
        $list = ProductsColorGroup::find()->orderby('name_color_group'.(Yii::$app->language=='uk'?'_ua':''))->all();
        $a = '';
        foreach ($list as $product) {
            $a .= "<li><a href='/shop?FilterForm%5Bcolor%5D=".$product->id_color_group."'>".$product->{'name_color_group'.(Yii::$app->language=='uk'?'_ua':'')}."</a></li>\n";
        }
        return $a;
    }

 public static function getMenuListShapes()
    {
        //id_product_type
        $list = ProductsShapes::find()->where("`status_disabled` = 0")->orderby('name_shape'.(Yii::$app->language=='uk'?'_ua':''))->all();
        $a = '';
        foreach ($list as $product) {
            $a .= "<li><a href='/shop?FilterForm%5Bshape%5D=".$product->id_shape."'>".$product->{'name_shape'.(Yii::$app->language=='uk'?'_ua':'')}."</a></li>\n";
        }
        return $a;
    }


}