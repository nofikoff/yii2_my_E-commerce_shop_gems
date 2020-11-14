<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reviews */

$this->title = 'Update Reviews: ' . $model->id_review;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_review, 'url' => ['view', 'id' => $model->id_review]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
