<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModelsStatusJournal */

$this->title = 'Create Models Status Journal';
$this->params['breadcrumbs'][] = ['label' => 'Models Status Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-status-journal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
