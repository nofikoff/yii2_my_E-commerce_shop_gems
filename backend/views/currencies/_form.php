<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Currencies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currencies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_currency')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
