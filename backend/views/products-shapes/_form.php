<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\fileinput\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsShapes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-shapes-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'status_disabled')->checkbox() ?>


    <?= $form->field($model, 'name_shape')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_shape_ua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_ru')->textarea(['class' => 'form-control', 'id' => 'pagecontent','type' => 'text','rows'=> 8]) ?>
    <?= $form->field($model, 'desc_uk')->textarea(['class' => 'form-control', 'id' => 'pagecontent','type' => 'text','rows'=> 8]) ?>


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
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
//Yii::$app->view->registerJsFile('/admin/plugins/ckeditor/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
Yii::$app->view->registerJsFile('/admin/js/redactor.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
Yii::$app->view->registerCssFile('/admin/css/redactor.css');
Yii::$app->view->registerJsFile('/admin/js/page.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
