<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypeReservedkeys */

$this->title = 'Update Parser Gemstype Reservedkeys: ' . ' ' . $model->id_1cparser_grk;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemstype Reservedkeys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_1cparser_grk, 'url' => ['view', 'id' => $model->id_1cparser_grk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parser-gemstype-reservedkeys-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
