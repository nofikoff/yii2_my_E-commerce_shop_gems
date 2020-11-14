<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemstypes */

$this->title = $model->id_1cparser_gemstypes;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemstypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemstypes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_1cparser_gemstypes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_1cparser_gemstypes], [
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
            'id_1cparser_gemstypes',
            'name_1cparser_gemstype',
            'exclude_1cparser_gemstype',
            'product_type_id',
        ],
    ]) ?>

</div>
