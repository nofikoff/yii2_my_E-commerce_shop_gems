<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColors */

$this->title = 'Update Products Colors: ' . $model->id_color;
$this->params['breadcrumbs'][] = ['label' => 'Products Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_color, 'url' => ['view', 'id' => $model->id_color]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-colors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
