<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeMultimedia */

$this->title = 'Update Products Type Multimedia: ' . $model->id_products_type_multimedia;
$this->params['breadcrumbs'][] = ['label' => 'Products Type Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_products_type_multimedia, 'url' => ['view', 'id' => $model->id_products_type_multimedia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-type-multimedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
