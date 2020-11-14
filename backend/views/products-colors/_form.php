<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\fileinput\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-colors-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_color_ua')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group field-labels-lfile required ">
        <label class="control-label" for="labels-lfile"><?= Yii::t('app', 'Image') ?></label>      
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
    
    <?= $form->field($model, 'rgb_num_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color_group_id')->dropDownList(ArrayHelper::map(\common\models\ProductsColorGroup::find()->all(), 'id_color_group', 'content')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
