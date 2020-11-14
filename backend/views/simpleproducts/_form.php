<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\fileinput\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Simpleproducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simpleproducts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_ua')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description_ua')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-labels-lfile required ">
        <div>
        <?=FileInput::widget([ 'model' => $model, 
            'attribute' => 'file',
            'thumbnail' => $model->getPreviewImage(), 
            'style' => FileInput::STYLE_IMAGE 
        ]);
        ?> 
        </div> 
        <div class="hint-block"></div>
        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
