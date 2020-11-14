<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Simpleproducts */

$this->title = 'Update Simpleproducts: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Simpleproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_simpleproduct]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simpleproducts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
