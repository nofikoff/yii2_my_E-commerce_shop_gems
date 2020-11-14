<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Color Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-color-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products Color Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_color_group',
            'name_color_group',
            //'rgb_color_group',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
