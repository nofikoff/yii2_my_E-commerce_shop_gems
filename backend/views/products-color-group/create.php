<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsColorGroup */

$this->title = 'Create Products Color Group';
$this->params['breadcrumbs'][] = ['label' => 'Products Color Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-color-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
