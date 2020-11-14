<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mailings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mailing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'anons:ntext',
            //'content:ntext',
            //'anons_ua:ntext',
            // 'content_ua:ntext',
            // 'title',
            // 'keywords',
            // 'url:url',
            // 'updated_at',
            // 'created_at',
            // 'uid',
            // 'img',
            // 'publish',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
