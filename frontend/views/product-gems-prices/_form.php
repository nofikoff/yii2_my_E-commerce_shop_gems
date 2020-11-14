<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPrices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-gems-prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_product_id')->textInput() ?>

    <?= $form->field($model, 'name_suffix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_d')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shape')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characteristics_str')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'treatment_type')->textInput() ?>

    <?= $form->field($model, 'synthetic_type')->textInput() ?>

    <?= $form->field($model, 'exclusive_type')->textInput() ?>

    <?= $form->field($model, 'recommended_type')->textInput() ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'color_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_promo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_points')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_karats')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'this_is_nabor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
