<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypeReservedkeys */

$this->title = $model->id_1cparser_grk;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemstype Reservedkeys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemstype-reservedkeys-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_1cparser_grk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_1cparser_grk], [
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
            'id_1cparser_grk',
            'keyword_1cparser_grk',
        ],
    ]) ?>

</div>
