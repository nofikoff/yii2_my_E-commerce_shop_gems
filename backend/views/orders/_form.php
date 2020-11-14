<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_orders')->hiddenInput()->label(false) ?>

    <?php
    echo $form->field($model, 'id_customers')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Select customer'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'date_added')->textInput() ?>
    <?= $form->field($model, 'contacts')->textInput() ?>
    <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'date_updated')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
