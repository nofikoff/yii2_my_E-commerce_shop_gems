<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorMultimediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-type-color-multimedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_my_products_type_color_multimedia') ?>

    <?= $form->field($model, 'product_type_color_id') ?>

    <?= $form->field($model, 'shape_id') ?>

    <?= $form->field($model, 'products_filepath') ?>

    <?= $form->field($model, 'flag_img_or_video') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
