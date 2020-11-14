<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColorGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-color-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_color_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_color_group_ua')->textInput(['maxlength' => true]) ?>
    
<!--    --><?//= $form->field($model, 'rgb_color_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'seo_uk')->textarea(['rows' => 6]) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
