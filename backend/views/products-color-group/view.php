<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColorGroup */

$this->title = $model->id_color_group;
$this->params['breadcrumbs'][] = ['label' => 'Products Color Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-color-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_color_group], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_color_group], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_color_group',
            'name_color_group',
            'rgb_color_group',
        ],
    ]) ?>

</div>
