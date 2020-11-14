<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolorsDefaulttype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemscolors-defaulttype-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id_1cparser_gcdt')->textInput() ?>

   <!-- <?/*= $form->field($model, 'product_type_id')->textInput() */?>

    --><?/*= $form->field($model, 'product_color_id')->textInput() */?>


    <?php
    echo '<label class="control-label" for="channels-remark_admin">Тип камня</label>';
    // выпадающее список
    $out = ArrayHelper::map(common\models\ProductType::find()->asArray()->orderBy('name_product_type')->all(), 'id_product_type', 'name_product_type');
    // без модели
    echo Html::dropDownList('ParserGemscolorsDefaulttype[product_type_id]', $model->product_type_id, $out, [
            'prompt' => '-Укажите тип камня-',
            'class' => 'form-control'
        ]) . "<br>";
    ?>


    <?php
    echo '<label class="control-label" for="channels-remark_admin">Цвет камня</label>';
    // выпадающее список
    $out = ArrayHelper::map(common\models\ProductsColors::find()->asArray()->orderBy('name_color')->all(), 'id_color', 'name_color');
    // без модели
    echo Html::dropDownList('ParserGemscolorsDefaulttype[product_color_id]', $model->product_color_id, $out, [
            'prompt' => '-Укажите цвет камня-',
            'class' => 'form-control'
        ]) . "<br>";
    ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
