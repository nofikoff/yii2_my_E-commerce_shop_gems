<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ModelsStatusJournal */

$this->title = $model->id_statusmodel_journal;
$this->params['breadcrumbs'][] = ['label' => 'Models Status Journals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-status-journal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_statusmodel_journal], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_statusmodel_journal], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_statusmodel_journal',
            'model_id',
            'datetime_statusmodel_journal',
            'statuscurrent_statusmodel_journal',
        ],
    ]) ?>

</div>
