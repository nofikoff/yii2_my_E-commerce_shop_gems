<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'image',
                'label' => Yii::t('app', 'Image'),
                'contentOptions' => ['class' => 'logo'],
                'value' => function ($data) {
                    return $data->imageurl;
                },
            ],
            'name_product_type',
            'status_disabled',
            [
                'attribute' => 'price_group_id',
                'format' => 'raw',
                'label' => Yii::t('app', 'Price Group'),
                'value' => function ($model) {
                    return $model->priceGroup->amount_price_group;
                },
            ],
            [
                'format' => 'html',
                'label' => Yii::t('app', 'Reviews'),
                'value' => function ($model) {
                    return '(' . Html::a(count($model->reviews), ['reviews / index', 'product_type_id' => $model->id_product_type]) . ') ' . Html::a('Add', ['reviews / create', 'product_type_id' => $model->id_product_type]);;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>



