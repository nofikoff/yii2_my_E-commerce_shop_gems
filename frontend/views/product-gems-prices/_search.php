<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPricesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-gems-prices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_product') ?>

    <?= $form->field($model, 'type_product_id') ?>

    <?= $form->field($model, 'name_suffix') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'size_h') ?>

    <?php // echo $form->field($model, 'size_w') ?>

    <?php // echo $form->field($model, 'size_d') ?>

    <?php // echo $form->field($model, 'shape') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'characteristics_str') ?>

    <?php // echo $form->field($model, 'treatment_type') ?>

    <?php // echo $form->field($model, 'synthetic_type') ?>

    <?php // echo $form->field($model, 'exclusive_type') ?>

    <?php // echo $form->field($model, 'recommended_type') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'color_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_promo') ?>

    <?php // echo $form->field($model, 'stock_points') ?>

    <?php // echo $form->field($model, 'stock_karats') ?>

    <?php // echo $form->field($model, 'date_added') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'this_is_nabor') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
