<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Gems Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gems-prices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Gems Prices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_product',
            [
                    'format' => 'image',
                    'label' => Yii::t('app', 'Image'),
                    'contentOptions' => ['class' => 'logo'], 
                    'value'=>function($data) { return $data->thumb(50, 50); },
            ], 
            [
                    'attribute' => 'type_product_id',
                    'format' => 'raw',
                    'value' => function ($model) {
                            return $model->typeProduct->content;
                    },
            ],
            'name_suffix',
            'sku',
            [
                    'attribute' => 'shape',
                    'format' => 'raw',
                    'value' => function ($model) {
                            return $model->shape0->content;
                    },
            ],
            'price',
            //'size_h',
            // 'size_w',
            // 'size_d',
            // 'shape',
            // 'weight',
            // 'characteristics_str',
            // 'treatment_type',
            // 'synthetic_type',
            // 'exclusive_type',
            // 'recommended_type',
            // 'country_id',
            // 'color_id',
            // 
            // 'price_promo',
            // 'stock_points',
            // 'stock_karats',
            'date_added',
            // 'date_updated',
            // 'this_is_nabor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
