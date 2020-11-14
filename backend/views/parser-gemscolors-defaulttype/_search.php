<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolorsDefaulttype_Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemscolors-defaulttype-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_1cparser_gcdt') ?>

    <?= $form->field($model, 'product_type_id') ?>

    <?= $form->field($model, 'product_color_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
