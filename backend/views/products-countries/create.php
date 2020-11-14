<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductsCountries */

$this->title = 'Create Products Countries';
$this->params['breadcrumbs'][] = ['label' => 'Products Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-countries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
