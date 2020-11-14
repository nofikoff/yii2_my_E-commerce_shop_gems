<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorMultimedia */

$this->title = 'Update Products Type Color Multimedia: ' . $model->id_my_products_type_color_multimedia;
$this->params['breadcrumbs'][] = ['label' => 'Products Type Color Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_my_products_type_color_multimedia, 'url' => ['view', 'id' => $model->id_my_products_type_color_multimedia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-type-color-multimedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
