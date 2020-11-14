<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsShapes */

$this->title = $model->id_shape;
$this->params['breadcrumbs'][] = ['label' => 'Products Shapes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-shapes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_shape], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_shape], [
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
            'id_shape',
            'name_shape',
            'name_shape_ua',
            'img_shape',
        ],
    ]) ?>

</div>
