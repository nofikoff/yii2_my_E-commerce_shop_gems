<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGemsPrices */

$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product Gems Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gems-prices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product], [
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
            'id_product',
            'type_product_id',
            'name_suffix',
            'sku',
            'size_h',
            'size_w',
            'size_d',
            'shape',
            'weight',
            'characteristics_str',
            'treatment_type',
            'synthetic_type',
            'exclusive_type',
            'recommended_type',
            'country_id',
            'color_id',
            'price',
            'price_promo',
            'stock_points',
            'stock_karats',
            'date_added',
            'date_updated',
            'this_is_nabor',
        ],
    ]) ?>

</div>
