<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductDesc */

$this->title = $model->id_product_desc;
$this->params['breadcrumbs'][] = ['label' => 'Product Descs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-desc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product_desc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product_desc], [
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
            'id_product_desc',
            'product_id',
            'desc_products:ntext',
            'desc_short_products:ntext',
            'desc_products_ua:ntext',
            'desc_short_products_ua:ntext',
        ],
    ]) ?>

</div>
