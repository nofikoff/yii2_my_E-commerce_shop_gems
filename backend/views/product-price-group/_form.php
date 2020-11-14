<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductPriceGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_price_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_price_group')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'amount_price_group')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
