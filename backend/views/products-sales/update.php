<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsSales */

$this->title = 'Update Products Sales: ' . $model->id_products_sales;
$this->params['breadcrumbs'][] = ['label' => 'Products Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_products_sales, 'url' => ['view', 'id' => $model->id_products_sales]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-sales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
