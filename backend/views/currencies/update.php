<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Currencies */

$this->title = 'Update Currencies: ' . $model->id_currency;
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_currency, 'url' => ['view', 'id' => $model->id_currency]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currencies-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
