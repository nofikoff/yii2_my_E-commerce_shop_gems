<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$product_type_id = 0;
if (isset(Yii::$app->request->queryParams['product_type_id'])) 
    $product_type_id = Yii::$app->request->queryParams['product_type_id'];
   
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($product_type_id) : ?>
        <?= $form->field($model, 'product_type_id')->textInput(['disabled'=>'disabled']) ?>
    <?php else: ?>
        <?= $form->field($model, 'product_type_id')->textInput() ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'author_review')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_review')->dropDownList([0 => 'модерация', 1 => 'утвержден']) ?>

    <?= $form->field($model, 'text_review')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_IP')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
