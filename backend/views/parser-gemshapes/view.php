<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ParserGemshapes */

$this->title = $model->id_1cparser_shapes;
$this->params['breadcrumbs'][] = ['label' => 'Parser Gemshapes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-gemshapes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_1cparser_shapes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_1cparser_shapes], [
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
            'id_1cparser_shapes',
            'name_1cparser_shapes',
            'exclude_1cparser_shape',
            'product_shape_id',
        ],
    ]) ?>

</div>
