<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Simpleproducts */

$this->title = 'Create Simpleproducts';
$this->params['breadcrumbs'][] = ['label' => 'Simpleproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simpleproducts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
