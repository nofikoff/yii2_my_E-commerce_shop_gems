<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mailing */

$this->title = 'Update Mailing: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mailings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mailing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
