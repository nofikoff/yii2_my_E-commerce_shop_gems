<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemshapes */

$this->title = 'Update Parser Gemshapes: ' . ' ' . $model->id_1cparser_shapes;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemshapes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_1cparser_shapes, 'url' => ['view', 'id' => $model->id_1cparser_shapes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parser-gemshapes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
