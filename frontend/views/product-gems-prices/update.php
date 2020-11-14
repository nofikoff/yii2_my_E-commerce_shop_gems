<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPrices */

$this->title = 'Update Product Gems Prices: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product Gems Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-gems-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
