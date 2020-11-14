<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemshapes_Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemshapes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_1cparser_shapes') ?>

    <?= $form->field($model, 'name_1cparser_shapes') ?>

    <?= $form->field($model, 'exclude_1cparser_shape') ?>

    <?= $form->field($model, 'product_shape_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
