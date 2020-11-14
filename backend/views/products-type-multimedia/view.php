<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeMultimedia */

$this->title = $model->id_products_type_multimedia;
$this->params['breadcrumbs'][] = ['label' => 'Products Type Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-type-multimedia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_products_type_multimedia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_products_type_multimedia], [
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
            'id_products_type_multimedia:datetime',
            'product_type_id',
            'products_filepath',
            'flag_img_or_video',
        ],
    ]) ?>

</div>
