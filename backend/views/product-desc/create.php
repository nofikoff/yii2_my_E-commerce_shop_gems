<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductDesc */

$this->title = 'Create Product Desc';
$this->params['breadcrumbs'][] = ['label' => 'Product Descs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-desc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
