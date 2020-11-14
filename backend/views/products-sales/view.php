<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductsSales */

$this->title = $model->id_products_sales;
$this->params['breadcrumbs'][] = ['label' => 'Products Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-sales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_products_sales], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_products_sales], [
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
            'id_products_sales',
            'product_id',
            'price_sale',
            'price_sale_enum',
            'added_product_sales',
            'expires_date_product_sales',
            'status',
        ],
    ]) ?>

</div>
