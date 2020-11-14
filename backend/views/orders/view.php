<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = 'Order #' . $model->id_orders . ' от ' . date('Y-m-d H-i-s', $model->date_added);
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">


    <!--    <p>-->
    <!--        --><? //= Html::a('Update', ['update', 'id' => $model->id_orders], ['class' => 'btn btn-primary']) ?>
    <!--        --><? //= Html::a('Delete', ['delete', 'id' => $model->id_orders], [
    //            'class' => 'btn btn-danger',
    //            'data' => [
    //                'confirm' => 'Are you sure you want to delete this item?',
    //                'method' => 'post',
    //            ],
    //        ]) ?>
    <!--    </p>-->


    <?php
    $dataProvider2 = new \yii\data\ActiveDataProvider([
        'query' => \common\models\OrdersProducts::find()->where(['id_orders_products' => $model->id_orders]),
    ]);


    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'id_orders_products',
            'name_orders_products',
            'id_product',
            'price',
            'quantity',
            'summ',
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]) ?>

    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <!--// USER-->
    <h1>User</h1>
    <?= DetailView::widget([
        'model' => \common\models\User::findOne(['id' => $model->id_customers]),
        'attributes' => [
//            'id',
//            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
//            'status',

            'name',
            'phone',
            'address',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('Y-m-d H-i-s', $model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('Y-m-d H-i-s', $model->updated_at);
                },
            ],
        ],
    ]) ?>


</div>
