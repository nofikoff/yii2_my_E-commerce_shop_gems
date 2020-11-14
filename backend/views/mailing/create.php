<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mailing */

$this->title = 'Create Mailing';
$this->params['breadcrumbs'][] = ['label' => 'Mailings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
