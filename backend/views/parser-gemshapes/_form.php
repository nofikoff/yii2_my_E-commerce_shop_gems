<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemshapes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemshapes-form">

    <?php $form = ActiveForm::begin(); ?>

    <pre>
   Примечание. Не обязательно добавлять ключевые слова - точно совпадающие по написанию с соответсвующим значением выпадающего списка.
   Значения выпадающего списка также учавствуют в парсинге выгрузки 1с
    </pre>

    <?= $form->field($model, 'name_1cparser_shapes')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'exclude_1cparser_shape')->textInput() ?>

<!--    --><?//= $form->field($model, 'product_shape_id')->textInput() ?>





    <?php
    echo '<label class="control-label" for="channels-remark_admin">Соответсвует форме камня на вебсайте</label>';
    // выпадающее список
    $out = ArrayHelper::map(common\models\ProductsShapes::find()->asArray()->orderBy('name_shape')->all(), 'id_shape', 'name_shape');
    // без модели
    echo Html::dropDownList('ParserGemshapes[product_shape_id]', $model->product_shape_id, $out, [
            'prompt' => '-Укажите форму камня-',
            'class' => 'form-control'
        ]) . "<br>";
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
