<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParserGemshapes_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Формы огранка 1с - вебсайт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemshapes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Форму огранки 1с', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<pre>
Все огранки которые парсер определяет как «Другие/(...)» - см. соответсвующее ключевое слово из первого столбика этой
    таблицы - автоматом попадает в будущий Суфикс2 названия камня
Так что, если речь о редких типах огранки – добавь в эту таблицу ключевое слово такой огранки и выбери «Другие/(...)»
</pre>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_1cparser_shapes',
            'name_1cparser_shapes',
//            'exclude_1cparser_shape',
//            'product_shape_id',

            [
                'attribute' => 'product_shape_id',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->productsShapes != null)
                        return $model->productsShapes->name_shape;
                },
                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
//                'filter' => $providersArr
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
