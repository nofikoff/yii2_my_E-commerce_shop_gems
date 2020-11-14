<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parser-gemstypes-form">

    <?php $form = ActiveForm::begin(); ?>

    <pre>
   Примечание. Не обязательно добавлять ключевые слова - точно совпадающие по написанию с соответсвующим значением выпадающего списка.
   Значения выпадающего списка также учавствуют в парсинге выгрузки 1с
    </pre>


    <?= $form->field($model, 'name_1cparser_gemstype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exclude_1cparser_gemstype')->checkbox() ?>


<!--    --><?//= $form->field($model, 'product_type_id')->textInput() ?>




    <?php
    echo '<label class="control-label" for="channels-remark_admin">Соответсвует типу камня на вебсайте</label>';
    // выпадающее список
    $out = ArrayHelper::map(common\models\ProductType::find()->asArray()->orderBy('name_product_type')->all(), 'id_product_type', 'name_product_type');
    // без модели
    echo Html::dropDownList('ParserGemstypes[product_type_id]', $model->product_type_id, $out, [
            'prompt' => '-Укажите тип камня-',
            'class' => 'form-control'
        ]) . "<br>";
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
