<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsCountries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-countries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
