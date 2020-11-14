<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сущности - ТИП+ЦВЕТ)';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="products-type-color-variation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <pre>Алгоритм добавления картинки сущности
    1. Выбираем сущность ТИП+ЦВЕТ - заходит в ее карточку (справа карандашик)
    2. В карточки сущности вверху зеленая кнопка "Управлять картинками"
    3. Получаем список всех картинок (в зависимости от Формы) данной сущности
    4. Нажимаем вверху зеленую кнопку "Добавить картинку" - указываем форму огранки, загружаем картинку

Алтернативный способ.
    Блииииииииииин спешил видео записал без звука
    Ну и ладно, в кафе звук поганый
    В двух словах что на видео:
    1. Заходишь под info@gems.com.ua и в сущности появляется ссылка на админку где добавить камушек этой сущности
    2. Определяешь какую картинку добавлять (или с компа или картинку по ссылке, в примере я копирую картинку прямой с сайта)
    3. На морде сайта в карточке сущности (где цены) для админа есть ссылка вида
    [ ИЗМЕНИТЬ СУЩНОСТЬ/ ДОБАВИТЬ КАРТИНКИ К ОГРАНКАМ СУЩНОСТИ ]
    4. Выбираешь форму огранки и добавляешь картинку
https://youtu.be/iqSX3u4mRmo
</pre>

    <a href="/admin/products-type-color-multimedia">Здесь</a>


    <p>
        <?= Html::a('Create Products Type Color Variation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                    'format' => 'image',
//                    'label' => Yii::t('app', 'Image'),
//                    'contentOptions' => ['class' => 'logo'],
//                    'value'=>function($data) {
//        print_r($data);
//        exit;
//        return $data->thumb(100, 100); },
//            ],
            [
                'attribute' => 'type_product_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->typeProduct->name;
                },
            ],
            'order_waight',
            [
                'attribute' => 'color_product_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->colorProduct->name;
                },
            ],
            ['label' => Yii::t('yii', 'Edit'),
                'format' => 'raw',
                'value' => function ($searchModel) {
                    return
                        Html::tag('a', '<span class="glyphicon glyphicon-edit" ></span>', ['class' => 'btn btn-info', 'href' => Yii::$app->urlManager->createUrl(['products-type-color-variation/update', 'id' => $searchModel->id])]) .
//                        Html::tag('a', '<span class="glyphicon glyphicon-picture" ></span>', ['class' => 'btn btn-info', 'href' => Yii::$app->urlManager->createUrl(['/products-type-color-multimedia', 'ProductsTypeColorMultimediaSearch[product_type_color_id]' => $searchModel->id])]).
                        Html::tag('a', '<span class="glyphicon glyphicon-trash" ></span>', ['class' => 'btn btn-danger', 'href' => Yii::$app->urlManager->createUrl(['products-type-color-variation/delete', 'id' => $searchModel->id])]);
                }
            ]
        ],
    ]); ?>
</div>
