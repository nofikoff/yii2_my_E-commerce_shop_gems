<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'content_ru') ?>
    <?= $form->field($model, 'content_ua') ?>

<!--    --><?//= $form->field($model, 'title') ?>

<!--    --><?//= $form->field($model, 'keywords') ?>

<!--    --><?php // echo $form->field($model, 'url') ?>

<!--    --><?php // echo $form->field($model, 'updated_at') ?>

<!--    --><?php // echo $form->field($model, 'created_at') ?>

<!--    --><?php // echo $form->field($model, 'uid') ?>

<!--    --><?php // echo $form->field($model, 'img') ?>

<!--    --><?php // echo $form->field($model, 'publish') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
