<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsShapes */

$this->title = 'Update Products Shapes: ' . $model->id_shape;
$this->params['breadcrumbs'][] = ['label' => 'Products Shapes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_shape, 'url' => ['view', 'id' => $model->id_shape]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-shapes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
