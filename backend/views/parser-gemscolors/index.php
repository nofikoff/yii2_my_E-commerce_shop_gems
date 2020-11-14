<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParserGemscolors_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цвета камней из 1с - вебсайт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemscolors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новый цвет 1с', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_1cparser_colors',
            'name_1cparser_colors',
//            'exclude_1cparser_color',
//            'product_color_id',


            [
                'attribute' => 'product_color_id',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->productsColors != null)
                        return $model->productsColors->name_color;
                },
                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
//                'filter' => $providersArr
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
