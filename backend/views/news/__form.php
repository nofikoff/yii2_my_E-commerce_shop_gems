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

    <?= $form->field($model, 'anons')->textArea(['class' => 'form-control', 'id' => 'anonscontent','type' => 'text','rows'=> 8,'required' => true]) ?>            

    <?= $form->field($model, 'content')->textArea(['class' => 'form-control', 'id' => 'pagecontent','type' => 'text','rows'=> 8,'required' => true]) ?>            

    <?= $form->field($model, 'anons_ua')->textArea(['class' => 'form-control', 'id' => 'anonscontent','type' => 'text','rows'=> 8,'required' => true]) ?>            

    <?= $form->field($model, 'content_ua')->textArea(['class' => 'form-control', 'id' => 'pagecontent','type' => 'text','rows'=> 8,'required' => true]) ?>            

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'uid')->hiddenInput()->label(false) ?>


    <div class="form-group field-news-keywords">
    <label class="control-label" for="news-keywords">Изображение</label>
    <?php

    if(isset($model->img) && file_exists(Yii::getAlias('@frontend').'/upload/news_img/'.$model->img))
    { 
        echo '<div>';
        echo $model->img;
        //echo Html::img(Yii::getAlias('@frontend').'/upload/news_img/'.$model->img, ['class'=>'img-responsive']);
        echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
        echo '</div>';
    }
    ?>
    <?= $form->field($model, 'file')->fileInput(['class' => 'form-image'])->label(false) ?>

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
