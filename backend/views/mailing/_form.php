<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textArea(['class' => 'form-control', 'id' => 'pagecontent','type' => 'text','rows'=> 8,'required' => true]) ?>            

    <?= $form->field($model, 'uid')->hiddenInput()->label(false) ?>


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
