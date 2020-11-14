<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductGemsPricesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Gems Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gems-prices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Gems Prices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_product',
            'type_product_id',
            //'name_suffix',
            //'sku',
            //'size_h',
            // 'size_w',
            // 'size_d',
             'shape',
            // 'weight',
            // 'characteristics_str',
            // 'treatment_type',
            // 'synthetic_type',
             'exclusive_type',
            // 'recommended_type',
            // 'country_id',
             'color_id',
            // 'price',
            // 'price_promo',
            // 'stock_points',
            // 'stock_karats',
            // 'date_added',
            // 'date_updated',
            // 'this_is_nabor',
             'brand',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
