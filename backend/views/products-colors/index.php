<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Colors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-colors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    Картинки - НЕ лепить . Здесь это бесполезно. Картинки у нас теперь
    <a href="/admin/products-type-color-multimedia">Здесь</a>

    <p>
        <?= Html::a('Create Products Colors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'format' => 'image',
                    'label' => Yii::t('app', 'Image'),
                    'contentOptions' => ['class' => 'logo'], 
                    'value'=>function($data) { return $data->imageurl; },
            ], 
            'name_color',
            //'rgb_num_color',
            //'color_group_id',
            [
                    'attribute' => 'color_group_id',
                    'format' => 'raw',
                    'label' => Yii::t('app', 'Color Group'),
                    'value' => function ($model) {
                            return $model->colorGroup->content;
                    },
            ],            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
