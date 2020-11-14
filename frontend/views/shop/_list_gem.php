<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$get = Yii::$app->request->get('FilterForm');
$url = Url::to(['shop/item',
    'id' => (isset($model->productsTypeColorVariation->id) && is_numeric($model->productsTypeColorVariation->id)) ? $model->productsTypeColorVariation->id : 0,
    'FilterForm[type]' => (isset($get['type']) && is_numeric($get['type'])) ? $get['type'] : 0,
    'FilterForm[color]' => (isset($get['color']) && is_numeric($get['color'])) ? $get['color'] : 0,
    'FilterForm[shape]' => (isset($get['shape']) && is_numeric($get['shape'])) ? $get['shape'] : 0,
    'FilterForm[action]' => (isset($get['action']) && is_numeric($get['action'])) ? $get['action'] : 0,
    'FilterForm[instock]' => (isset($get['instock']) && is_numeric($get['instock'])) ? $get['instock'] : 0,
    'FilterForm[exclusive]' => (isset($get['exclusive']) && is_numeric($get['exclusive'])) ? $get['exclusive'] : 0,
    'FilterForm[this_is_nabor]' => (isset($get['this_is_nabor']) && is_numeric($get['this_is_nabor'])) ? $get['this_is_nabor'] : 0,
    'FilterForm[treatment_type]' => (isset($get['treatment_type']) && is_numeric($get['treatment_type'])) ? $get['treatment_type'] : 0,
    'FilterForm[priceFrom]' => (isset($get['priceFrom']) && is_numeric($get['priceFrom'])) ? $get['priceFrom'] : 0,
    'FilterForm[priceTo]' => (isset($get['priceTo']) && is_numeric($get['priceTo'])) ? $get['priceTo'] : 0,
    'FilterForm[width]' => (isset($get['width'])) ? $get['width'] : 0,
    'FilterForm[height]' => (isset($get['height'])) ? $get['height'] : 0,
]);

?>

<!--template shop/ index-gem.php / _list_gem.php-->


<?php
if (isset($model->productsTypeColorVariation->id)) {


    // ВНИМАНИЕ ссылкт формируются не така как в _list.php
    ?>


    <div class="catalogBlock">
        <div class="catalogBlockIn">
            <div
                    class="cB_img"><a href="<?= $url ?>"><img data-src="<?= $model->productsTypeColorVariation->thumb(100, 100, $model->shape) ?>"
                                                              alt=""></a></div>
            <div class="cB_txt">
                <a href="#">
                    <h6><?= Html::a(Html::encode($model->productsTypeColorVariation->typeProduct->name), $url, ['class' => '']) ?></h6>
                </a>

                <p><?= $model->productsTypeColorVariation->colorProduct->{'name_color' . (Yii::$app->language == 'uk' ? '_ua' : '')} ?></p>

            </div>
            <div class="clear"></div>


            <?php
            // если не включен фильтр по цене
            //. ' ' . $model->productsTypeColorVariation->minCost
            //if ($model->productsTypeColorVariation->minCost > 0 AND !isset(Yii::$app->request->get('FilterForm')['priceTo']))
            echo '<div class="cB_price">' . Yii::t('app', 'цены >>') . '</div> '; ?>

        </div>
    </div><!-- .catalogBlock -->
    <?php
}
?>
