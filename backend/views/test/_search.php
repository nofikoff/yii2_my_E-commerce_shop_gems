<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModelsStatusJournal_Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-status-journal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_statusmodel_journal') ?>

    <?= $form->field($model, 'model_id') ?>

    <?= $form->field($model, 'datetime_statusmodel_journal') ?>

    <?= $form->field($model, 'statuscurrent_statusmodel_journal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
