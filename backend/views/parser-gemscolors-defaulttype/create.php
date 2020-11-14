<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolorsDefaulttype */

$this->title = 'Новый дефолтный цвет';
$this->params['breadcrumbs'][] = ['label' => 'Цвета камней по умолчанию', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemscolors-defaulttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
