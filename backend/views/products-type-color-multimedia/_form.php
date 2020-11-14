<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\fileinput\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorMultimedia */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="products-type-color-multimedia-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_type_color_id')->hiddenInput()->label(false) ?>

    <div class="form-group field-labels-lfile required ">
        <?= $form->field($model, 'shape_id')->dropDownList(ArrayHelper::map(\common\models\ProductsShapes::find()->all(), 'id_shape', 'content')) ?>
     
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
    <?= $form->field($model, 'flag_img_or_video')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
