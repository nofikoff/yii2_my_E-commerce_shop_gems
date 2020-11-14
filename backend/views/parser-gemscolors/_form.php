<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemscolors-form">

    <?php $form = ActiveForm::begin(); ?>

    <pre>
   Примечание. Не обязательно добавлять ключевые слова - точно совпадающие по написанию с соответсвующим значением выпадающего списка.
   Значения выпадающего списка также учавствуют в парсинге выгрузки 1с
    </pre>


    <?= $form->field($model, 'name_1cparser_colors')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'exclude_1cparser_color')->textInput() ?>

<!--    --><?//= $form->field($model, 'product_color_id')->textInput() ?>

    <?php
    echo '<label class="control-label" for="channels-remark_admin">Соответсвует цвету на вебсайте</label>';
    // выпадающее список
    $out = ArrayHelper::map(common\models\ProductsColors::find()->asArray()->orderBy('name_color')->all(), 'id_color', 'name_color');
    // без модели
    echo Html::dropDownList('ParserGemscolors[product_color_id]', $model->product_color_id, $out, [
            'prompt' => '-Укажите цвет камня-',
            'class' => 'form-control'
        ]) . "<br>";
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
