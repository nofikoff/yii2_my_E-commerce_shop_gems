<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypes */

$this->title = 'Update Parser Gemstypes: ' . ' ' . $model->id_1cparser_gemstypes;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemstypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_1cparser_gemstypes, 'url' => ['view', 'id' => $model->id_1cparser_gemstypes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parser-gemstypes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
