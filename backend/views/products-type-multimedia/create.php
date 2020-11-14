<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeMultimedia */

$this->title = 'Create Products Type Multimedia';
$this->params['breadcrumbs'][] = ['label' => 'Products Type Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-type-multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
