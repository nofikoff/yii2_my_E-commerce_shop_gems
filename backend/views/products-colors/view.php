<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsColors */

$this->title = $model->id_color;
$this->params['breadcrumbs'][] = ['label' => 'Products Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-colors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_color], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_color], [
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
            'id_color',
            'name_color',
            'img_color',
            'rgb_num_color',
            'color_group_id',
        ],
    ]) ?>

</div>
