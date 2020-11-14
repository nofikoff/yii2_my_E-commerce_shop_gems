<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products Sales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product_id',
            [
                'format' => 'html',
                'label' => Yii::t('app', 'Product'),
								'attribute' => 'product_id',
								'value' => function ($model) {
									if (isset($model->product->name))
										return $model->product->name;
								},
             ],
            'price_sale',
            'price_sale_enum',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
