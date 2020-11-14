<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Simpleproducts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpleproducts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Simpleproducts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'format' => 'image',
                    'label' => Yii::t('app', 'Image'),
                    'contentOptions' => ['class' => 'logo'], 
                    'value'=>function($data) { return $data->thumb(100, 100); },
            ],
            'name',
            'price',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
