<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$a = Yii::t('app', 'Сопутсвующие товары для драгоценных камней');
$this->params['breadcrumbs'][] = $a;

$this->title = $a . ' | ' . Yii::t('app', 'Купить камень в магазине Центури');


?>
<div class="simpleproducts-index">

    <h1><?= Html::encode($a) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'id' => 'theDatatable',
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'format' => 'image',
                'label' => '',
                'contentOptions' => ['class' => 'simpleproductsimg'],
                'value' => function ($data) {
                    return $data->thumb(100, 100);
                },
            ],

            'name' . (Yii::$app->language == 'uk' ? '_ua' : ''),


            [
                'attribute' => 'description' . (Yii::$app->language == 'uk' ? '_ua' : ''),

                'format' => 'html',
            ],


            [
                'attribute' => 'price',

                'format' => 'raw',
                'value' => function ($data) {
                    return $data->cost . ' ' . Yii::$app->currency->getCurrency()->name_currency;
                },
            ],


            [
                'format' => 'html',
                'value' => function ($model) {
                    return '<a href="' . Yii::$app->urlManager->createUrl(['shop/buy', 'id' => $model->id, 'type' => 'simple']) . '" class = "btn btn-success">' . Yii::t('app', 'В корзину') . '</a>';
                },
            ],
        ],
    ]); ?>
</div>
