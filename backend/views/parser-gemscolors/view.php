<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemscolors */

$this->title = $model->id_1cparser_colors;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemscolors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemscolors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_1cparser_colors], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_1cparser_colors], [
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
            'id_1cparser_colors',
            'name_1cparser_colors',
            'exclude_1cparser_color',
            'product_color_id',
        ],
    ]) ?>

</div>
