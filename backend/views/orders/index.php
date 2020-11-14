<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_orders',
//            'name_orders',
//            'id_customers',

//            'date_added',

            [
                'attribute' => 'date_added',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('Y-m-d H-i', $model->date_added);
                },
            ],
//            'date_updated',

    [
        'attribute' => 'contacts',
        'format' => 'raw',
        'value' => function ($model) {
            return "<a href='https://gems.ua/admin/orders/view?id=".$model->id_orders."'>".$model->contacts."</a>";
        },
    ],


            'comments',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
