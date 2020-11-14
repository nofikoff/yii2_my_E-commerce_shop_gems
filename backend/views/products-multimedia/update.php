<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsMultimedia */

$this->title = 'Update Products Multimedia: ' . $model->id_products_multimedia;
$this->params['breadcrumbs'][] = ['label' => 'Products Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_products_multimedia, 'url' => ['view', 'id' => $model->id_products_multimedia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-multimedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
