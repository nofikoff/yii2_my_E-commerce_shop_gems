<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPrices */

$this->title = 'Create Product Gems Prices';
$this->params['breadcrumbs'][] = ['label' => 'Product Gems Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gems-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
