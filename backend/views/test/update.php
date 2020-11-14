<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModelsStatusJournal */

$this->title = 'Update Models Status Journal: ' . ' ' . $model->id_statusmodel_journal;
$this->params['breadcrumbs'][] = ['label' => 'Models Status Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_statusmodel_journal, 'url' => ['view', 'id' => $model->id_statusmodel_journal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="models-status-journal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
