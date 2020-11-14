<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorMultimedia */

$this->title = 'Create Products Type Color Multimedia';
$this->params['breadcrumbs'][] = ['label' => 'Products Type Color Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-type-color-multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
