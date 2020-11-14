<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductPriceGroup */

$this->title = 'Create Product Price Group';
$this->params['breadcrumbs'][] = ['label' => 'Product Price Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
