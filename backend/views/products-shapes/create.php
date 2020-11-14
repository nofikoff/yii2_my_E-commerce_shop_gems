<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsShapes */

$this->title = 'Create Products Shapes';
$this->params['breadcrumbs'][] = ['label' => 'Products Shapes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-shapes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
