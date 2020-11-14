<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsSales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\common\models\ProductGemsPrices::find()->all(),'id_product','id_product'),
        'id'=>'sGoodTrack',
        'options' => ['placeholder' => 'Select a good ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'price_sale')->textInput() ?>

    <?= $form->field($model, 'price_sale_enum')->dropDownList([ 'procent' => '%', 'currency' => 'Currency', ], ['prompt' => '']) ?>

    <?php
    echo '<label class="control-label">Дата создания скидки</label>';
    echo DatePicker::widget([
        'name' => 'ProductsSales[added_product_sales]',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->added_product_sales,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd.mm.yyyy'
        ]
    ]);
    ?>
    <br/>

    <?php
    echo '<label class="control-label">Дата действия скидки</label>';
    echo DatePicker::widget([
        'name' => 'ProductsSales[expires_date_product_sales]',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->expires_date_product_sales,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd.mm.yyyy'
        ]
    ]);
    ?>
    <br/>


    <?= $form->field($model, 'status')->dropDownList([ 1 => 'активна', 0 => 'отключена', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
