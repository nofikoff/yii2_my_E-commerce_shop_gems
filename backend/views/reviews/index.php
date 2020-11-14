<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;

$product_type_id = 0;
if (isset(Yii::$app->request->queryParams['product_type_id'])) 
    $product_type_id = Yii::$app->request->queryParams['product_type_id'];
    
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back', ['/product-type'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Reviews', ['create'.($product_type_id?'?product_type_id='.$product_type_id:'')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_review',
            [
                    'attribute' => 'product_type_id',
                    'format' => 'raw',
                    'label' => Yii::t('app', 'Product Type'),
                    'value' => function ($model) {
                            return $model->productType->content;
                    },
            ],
            'author_review',
            'text_review',
            [
                    'attribute' => 'status_review',
                    'format' => 'raw',
                    'label' => Yii::t('app', 'Status'),
                    'value' => function ($model) {
                            return $model->status[$model->status_review];
                    },
            ],
            // 'author_city',
            // 'author_IP',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
