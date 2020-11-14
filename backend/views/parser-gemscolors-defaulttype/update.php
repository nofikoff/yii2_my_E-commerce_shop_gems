<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolorsDefaulttype */

$this->title = 'Update Parser Gemscolors Defaulttype: ' . ' ' . $model->id_1cparser_gcdt;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemscolors Defaulttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_1cparser_gcdt, 'url' => ['view', 'id' => $model->id_1cparser_gcdt]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parser-gemscolors-defaulttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
