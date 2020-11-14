<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsTypeColorMultimedia */

$this->title = $model->id_my_products_type_color_multimedia;
$this->params['breadcrumbs'][] = ['label' => 'Products Type Color Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-type-color-multimedia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_my_products_type_color_multimedia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_my_products_type_color_multimedia], [
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
            'id_my_products_type_color_multimedia:datetime',
            'product_type_color_id',
            'shape_id',
            'products_filepath',
            'flag_img_or_video',
        ],
    ]) ?>

</div>
