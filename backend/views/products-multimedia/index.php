<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Multimedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products Multimedia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_products_multimedia:datetime',
            'product_id',
            'products_filepath',
            'flag_img_or_video',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
