<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductDesc */

$this->title = 'Update Product Desc: ' . $model->id_product_desc;
$this->params['breadcrumbs'][] = ['label' => 'Product Descs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product_desc, 'url' => ['view', 'id' => $model->id_product_desc]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-desc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
