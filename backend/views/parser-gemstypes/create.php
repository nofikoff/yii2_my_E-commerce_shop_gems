<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypes */

$this->title = 'Новый тип камня 1с - вебсайт';
$this->params['breadcrumbs'][] = ['label' => 'Типы камней 1с - вебсайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemstypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
