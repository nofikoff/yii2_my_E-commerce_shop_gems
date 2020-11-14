<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParserGemscolorsDefaulttype_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цвета камней по умолчанию';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemscolors-defaulttype-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый дефолтный цвет', ['create'], ['class' => 'btn btn-success']) ?>



<pre>
    Если в строке 1с отсутсвует явное указаение цвета, парсер возьмет цвет из этой таблицы
    Для некоторых типов камней цвет известен по дефолту:
    </pre>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_1cparser_gcdt',

            [
                'attribute' => 'product_type_id',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->productType != null)
                        return $model->productType->name_product_type;
                },
                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
//                'filter' => $providersArr
            ],

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
