<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParserGemstypeReservedkeys_Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Зарезервированные слова';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="parser-gemstype-reservedkeys-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новое ключевое слово', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


<pre>
    Если в строке 1с встречается ОПИСАНИЕ к стандартному типу камня и его надо сохранить - добавляем в эту таблицу соответсвующее слово
    В БД вебсайта эта приставка будет сохранена в отдельном поле - суфиксе динамического названия камня ТИП + ЦВЕТ + ОГРАНКА + СУФИКС
</pre>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_1cparser_grk',
            'keyword_1cparser_grk',
            'russian_1cparser_grk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
