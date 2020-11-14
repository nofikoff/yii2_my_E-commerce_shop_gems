<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColorGroup */

$this->title = 'Update Products Color Group: ' . $model->id_color_group;
$this->params['breadcrumbs'][] = ['label' => 'Products Color Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_color_group, 'url' => ['view', 'id' => $model->id_color_group]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-color-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
