<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemshapes */

$this->title = 'Новая форма огранки 1с';
$this->params['breadcrumbs'][] = ['label' => 'Формы огранки 1с - вебсайт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemshapes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
