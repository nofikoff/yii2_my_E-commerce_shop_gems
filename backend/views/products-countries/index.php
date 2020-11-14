<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-countries-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products Countries', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_country',
            'code_country',
            'name_country',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
