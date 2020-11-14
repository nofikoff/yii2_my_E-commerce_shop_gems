<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPrices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-gems-prices-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'type_product_id')->dropDownList(ArrayHelper::map(\common\models\ProductType::find()->all(), 'id_product_type', 'content')) ?>


    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_d')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shape')->dropDownList(ArrayHelper::map(\common\models\ProductsShapes::find()->all(), 'id_shape', 'content')) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characteristics_str')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'treatment_type')->dropDownList([1 => 'ручная огранка/обработка', 2 => 'машинная огранка/ обработка']) ?>

    <?= $form->field($model, 'synthetic_type')->dropDownList([1 => 'синтетический', 0 => 'натуральный']) ?>

    <?= $form->field($model, 'exclusive_type')->checkBox() ?>

    <?= $form->field($model, 'recommended_type')->checkBox() ?>


    <?= $form->field($model, 'color_id')->dropDownList(ArrayHelper::map(\common\models\ProductsColors::find()->all(), 'id_color', 'content')) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'price_promo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_points')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_karats')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'this_is_nabor')->checkBox() ?>

    <?= $form->field($model, 'brand')->dropDownList([
        1 => 'модельные камни',
        2 => 'Калиброванные вставки Swarovski gemstones',
        3 => 'Swarovski другие бренды',
        4 => 'Куб. оксид циркония Swarovski',
    ], ['prompt' => '']) ?>





    <?= $form->field($model, 'name_suffix_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name_suffix_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_name_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'country_name_uk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_products_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'desc_products_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nabor_notes_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'nabor_notes_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nabor_seo_desc_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'nabor_seo_desc_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_title_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'seo_title_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_keywords_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'seo_keywords_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seo_desc_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'seo_desc_uk')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_added')->textInput(['maxlength' => true]) ?>





    <?php
    if (isset($model->imageurl))
        echo '<img src="' . $model->imageurl . '" width="50px" />';
    ?>
    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*,video/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'showUploadedThumbs' => false,
        ]
    ]); ?>


    <?php
    /* echo $this->render('file/_form', [
                 'model' => $model,
                 'form'  => $form,
             ]);
*/
    ?>
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
