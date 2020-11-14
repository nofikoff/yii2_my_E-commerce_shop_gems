<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            [
                'attribute' => 'sortorder',
                'label' => 'Вес.коэфф',
            ],
 [
                'attribute' => 'name',
                'label' => 'Название Ру/Укр',
                'format' => 'raw',
                'value' => function ($model) {
                    return
                    ' <a href="/ru/news/'.$model->url.'">' . $model->name . '</a> '.
                    ' <br><a href="/uk/news/'.$model->url.'">' . $model->name_ua . '</a> ';
                },

            ],


            //'content:ntext',
            //'title',
            //'keywords',
            'url',
            'updated_at',
            //'created_at',
            //'uid',
            // 'img',
            //'publish',

           // ['class' => 'yii\grid\ActionColumn'],
            ['label' => Yii::t('yii', 'Edit'),
                'format' => 'raw',
                'value' =>  function ($searchModel){
                    return
                        Html::tag('a', '<span class="glyphicon glyphicon-edit" ></span>', ['class' => 'btn btn-info', 'href' => Yii::$app->urlManager->createUrl(['news/update', 'id' => $searchModel->id])]).
                        Html::tag('a', '<span class="glyphicon glyphicon-trash" ></span>', ['class' => 'btn btn-danger', 'href' => Yii::$app->urlManager->createUrl(['news/delete', 'id' => $searchModel->id])]);
                }
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
