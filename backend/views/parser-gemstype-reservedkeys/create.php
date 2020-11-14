<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypeReservedkeys */

$this->title = 'Новое слово';
$this->params['breadcrumbs'][] = ['label' => 'Зарезервированные слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemstype-reservedkeys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
