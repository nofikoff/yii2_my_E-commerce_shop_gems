<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypeReservedkeys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemstype-reservedkeys-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id_1cparser_grk')->textInput() ?>

    <?= $form->field($model, 'keyword_1cparser_grk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'russian_1cparser_grk')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
