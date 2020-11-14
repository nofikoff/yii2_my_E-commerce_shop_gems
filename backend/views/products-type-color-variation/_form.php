<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\fileinput\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorVariation */
/* @var $form yii\widgets\ActiveForm */

$shapes = \common\models\ProductsShapes::find()->all();

?>


<div class="products-type-color-variation-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'order_waight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_product_id')->dropDownList(ArrayHelper::map(\common\models\ProductType::find()->all(), 'id_product_type', 'content')) ?>

    <?= $form->field($model, 'color_product_id')->dropDownList(ArrayHelper::map(\common\models\ProductsColors::find()->all(), 'id_color', 'content')) ?>
    
    <?= $form->field($model, 'desc_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_products_ua')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc_short_products_ua')->textarea(['rows' => 6]) ?>

<?php
if (false){
foreach ($shapes as $shape) {
$model->shape = $shape->id_shape;

?>
    <div class="form-group field-labels-lfile required ">
        <label class="control-label" for="labels-lfile"><?= $shape->name_shape.' ('.$shape->id_shape.')' ?></label>      
        <div>
        <?=FileInput::widget([ 'model' => $model, 
            'attribute' => 'file['.$shape->id_shape.']',
            'thumbnail' => $model->getPreviewImage(), 
            'style' => FileInput::STYLE_IMAGE 
        ]);
        ?> 
        </div> 
        <div class="hint-block"></div>
        <div class="help-block"></div>
    </div>
<?php
}
}
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

