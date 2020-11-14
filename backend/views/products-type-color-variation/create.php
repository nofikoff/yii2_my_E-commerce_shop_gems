<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorVariation */

$this->title = 'Create Products Type Color Variation';
$this->params['breadcrumbs'][] = ['label' => 'Products Type Color Variations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-type-color-variation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
