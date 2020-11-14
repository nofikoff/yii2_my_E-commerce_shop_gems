<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParserGemstypes_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы камней 1с - вебсайт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemstypes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тип камня 1с - вебсайт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_1cparser_gemstypes',
            'name_1cparser_gemstype',
//            'exclude_1cparser_gemstype',

            [
                'attribute' => 'exclude_1cparser_gemstype',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->exclude_1cparser_gemstype ? '<font color="red">Исключить</font>' : 'импортировать';
                },
                'contentOptions' => ['style' => 'min-width: 50px; max-width: 100px; '], // <-- right here
                'filter' => [0 => 'Импортируем', 1 => 'Исключены']
            ],


//            'product_type_id',

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


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
