<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorVariation */

$this->title = 'Update Products Type Color Variation: ' . $model->id_products_type_color_variation;
$this->params['breadcrumbs'][] = ['label' => 'Products Type Color Variations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_products_type_color_variation, 'url' => ['view', 'id' => $model->id_products_type_color_variation]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-type-color-variation-update">

    <h1><?= Html::encode($this->title) ?></h1>

   <p>
        <?= Html::a('Управлять картинками', ['/products-type-color-multimedia', 'ProductsTypeColorMultimediaSearch[product_type_color_id]' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
