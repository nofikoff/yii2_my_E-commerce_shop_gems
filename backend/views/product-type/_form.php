<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileinput\FileInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProductType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-type-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'status_disabled')->checkbox() ?>



    <?= $form->field($model, 'name_product_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_product_type_ua')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'price_group_id')->dropDownList(ArrayHelper::map(\common\models\ProductPriceGroup::find()->select(['id_price_group', 'name_price_group'])->all(), 'id_price_group', 'name_price_group')) ?>

    <?= $form->field($model, 'desc_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_products_ua')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products_ua')->textarea(['rows' => 6]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
