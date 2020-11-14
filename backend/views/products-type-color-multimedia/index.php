<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductsTypeColorMultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Картинки для Сущности(Тип+Цвет) и Формы';
$this->params['breadcrumbs'][] = $this->title;

$get = Yii::$app->request->get();
$sid = 0;
if (isset($get['ProductsTypeColorMultimediaSearch']['product_type_color_id']) && $get['ProductsTypeColorMultimediaSearch']['product_type_color_id'] > 0 )
$sid = $get['ProductsTypeColorMultimediaSearch']['product_type_color_id'];

?>
<div class="products-type-color-multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить картинку', ['create','sid' => $sid], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Вернуться сущность ТИП + Цвет', ['products-type-color-variation/update','id' => $sid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'product_type_color_id',
                    'format' => 'raw',
                    'label' => Yii::t('app', 'Тип + Цвет'),
                    'value' => function ($model) {
                            return $model->productTypeColor->typeProduct->name.' '.$model->productTypeColor->colorProduct->name;
                    },
            ],
            [
                    'format' => 'image',
                    'label' => Yii::t('app', 'Image'),
                    'contentOptions' => ['class' => 'logo'], 
                    'value'=>function($data) { return $data->thumb(100, 100); },
            ],
            [
                    'attribute' => 'shape_id',
                    'format' => 'raw',
                    'label' => Yii::t('app', 'Огранка'),
                    'value' => function ($model) {
                            return $model->shapes->name;
                    },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
