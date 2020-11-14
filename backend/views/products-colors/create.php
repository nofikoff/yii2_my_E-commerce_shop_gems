<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsColors */

$this->title = 'Create Products Colors';
$this->params['breadcrumbs'][] = ['label' => 'Products Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-colors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
