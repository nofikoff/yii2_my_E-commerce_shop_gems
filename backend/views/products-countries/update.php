<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsCountries */

$this->title = 'Update Products Countries: ' . $model->id_country;
$this->params['breadcrumbs'][] = ['label' => 'Products Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_country, 'url' => ['view', 'id' => $model->id_country]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-countries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
