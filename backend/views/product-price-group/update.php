<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductPriceGroup */

$this->title = 'Update Product Price Group: ' . $model->id_price_group;
$this->params['breadcrumbs'][] = ['label' => 'Product Price Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_price_group, 'url' => ['view', 'id' => $model->id_price_group]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-price-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
