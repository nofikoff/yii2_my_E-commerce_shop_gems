<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModelsStatusJournal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-status-journal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model_id')->textInput() ?>

    <?= $form->field($model, 'datetime_statusmodel_journal')->textInput() ?>

    <?= $form->field($model, 'statuscurrent_statusmodel_journal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
