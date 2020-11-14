<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductDesc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-desc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'desc_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_products_ua')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products_ua')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
