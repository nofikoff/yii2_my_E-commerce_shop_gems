<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolors */

$this->title = 'Update Parser Gemscolors: ' . ' ' . $model->id_1cparser_colors;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemscolors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_1cparser_colors, 'url' => ['view', 'id' => $model->id_1cparser_colors]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parser-gemscolors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
