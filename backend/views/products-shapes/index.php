<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Shapes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-shapes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products Shapes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'format' => 'image',
                    'label' => Yii::t('app', 'Image'),
                    'contentOptions' => ['class' => 'logo'], 
                    'value'=>function($data) { return $data->imageurl; },
            ],
            'id_shape',
            'name_shape',
            'status_disabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
