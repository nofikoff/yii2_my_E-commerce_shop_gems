<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


//$this->title = Yii::t('app', 'Каталог камней');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Драгоценные камни'), 'url' => ['/shop/']];
if ($model->exclusive_type) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Эксклюзив') . '', 'url' => ['/shop?FilterForm%5Bexclusive%5D=1']];
}

$this->params['breadcrumbs'][] = ['label' => '' . $model->typeProduct->name, 'url' => ['/shop?FilterForm%5Btype%5D=' . $model->typeProduct->id_product_type]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'цвет') . ' ' . $model->color->name, 'url' => ['/shop?FilterForm%5Bcolor%5D=' . $model->color->color_group_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'форма') . ' ' . $model->shape0->name_shape, 'url' => ['/shop?FilterForm%5Bshape%5D=' . $model->shape0->id_shape]];


foreach ($this->params['breadcrumbs'] as $a) {
    if (isset($a['label'])) {
        $this->title .= ' | ' . $a['label'];
    } else {
        $this->title .= ' | ' . $a;
    }
}
$this->title = trim($this->title, ' |') . ' | ' . Yii::t('app', 'Купить камень в магазине Центури');


if (isset($model->productDescs->{'seo_title_' . Yii::$app->language})
    AND
    trim($model->productDescs->{'seo_title_' . Yii::$app->language}) <> ''
) {
    $this->title = $model->productDescs->{'seo_title_' . Yii::$app->language};
    $this->registerMetaTag(['name' => 'description', 'content' => $model->productDescs->{'seo_desc_' . Yii::$app->language}]);
    $this->registerMetaTag(['name' => 'keywords', 'content' => $model->productDescs->{'seo_keywords_' . Yii::$app->language}]);
}

//$model->{'seo_title_'.Yii::$app->language}
//$model->{'seo_keywords_'.Yii::$app->language}
//$model->{'seo_desc_'.Yii::$app->language}


$curr = Yii::$app->currency->getCurrency();

?>
<!--template shop/gems.php-->

<style>
#easy_zoom{
    width:600px;
    height:400px;
    border:5px solid #eee;
    background:#fff;
    color:#333;
    position:absolute;
    top:60px;
    left:400px;
    overflow:hidden;
    -moz-box-shadow:0 0 10px #777;
    -webkit-box-shadow:0 0 10px #777;
    box-shadow:0 0 10px #777;
    /* vertical and horizontal alignment used for preloader text */
    line-height:400px;
    text-align:center;
    z-index: 30;
    }
#slider-single > li:nth-child(1n+2) { display: none }    
</style>
<div class="tovarMainContent">
    <div class="tovarM_left">
        <div id='easy_zoom' style="display:none;"></div>
        <div class="tovarSlider">
            <div class="tovarSliderMain">
                <ul id="slider-single">
                    <?php
                    // КОЛОРОБОКС всплывающие большие картинки colorbox

                    //                    if ($_SERVER['REMOTE_ADDR'] == '195.69.221.201') {
                    //                        print_r($model->fullImages);
                    //                        exit;
                    //                    }
                    foreach ($model->fullImages as $img) {
                        echo '<li>
                        <img class="group1 jqzoom" width="280px"
                        data-zoom="' . $img->products_filepath . '"
                        src="' . $img->products_filepath . '" alt=""  />
</li>';
                    }
                    if (!isset($img))
                        echo '<li><img src="/img-gems/no-foto.jpg" alt=""/></li>';
                    ?>
                </ul>
            </div>
            <div class="thumbs">
                <ul id="thumbs">

                    <?php
                    $a = $model->thumbImages(50, 70);
                    if (sizeof($a) > 1)
                        foreach ($a as $img) {
                            echo '<li><img src="' . $img . '" alt=""/></li>';
                        }

                    ?>

                </ul>
                <button type="button" class="tPrev slick-prev"><img src="/pic/prev.png" alt=""></button>
                <button type="button" class="tNext slick-next"><img src="/pic/next.png" alt=""></button>
            </div>
        </div>
        <!-- .topSlider -->
        <!--        <div class="socShare">-->
        <!--            <a href="#"><img src="/pic/fb.png" alt=""></a>-->
        <!--            <a href="#"><img src="/pic/twitt.png" alt=""></a>-->
        <!--            <a href="#"><img src="/pic/insta.png" alt=""></a>-->
        <!--            <a href="#"><img src="/pic/google.png" alt=""></a>-->
        <!--            <a href="#"><img src="/pic/youtube.png" alt=""></a>-->
        <!--        </div>-->
        <!-- .socShare -->
    </div>
    <!-- .tovarM_left -->
    <?php
    if ($model->exclusive_type) {
        echo " <span class='h2greys'>" . Yii::t('app', 'Эксклюзивные драгоценные камни') . "</span><br>";
    }
    ?>
    <div class="tovT"><?= $model->typeProduct->name ?>
        <?php echo (isset($model->productDescs->{'name_suffix_' . Yii::$app->language}) AND $model->productDescs->{'name_suffix_' . Yii::$app->language}!='') ? ' - '.$model->productDescs->{'name_suffix_' . Yii::$app->language} : ''; ?>

    </div>
    <div class="minDescr">
        <?= Yii::t('app', 'Цвет') ?>: <span class="greys"><?= $model->color->name ?></span><br>
        <?= Yii::t('app', 'Форма') ?>: <span class="greys"><?= $model->shape0->name_shape ?></span>
    </div>

    <div class="tovarM_right">
        <div class="minDescr">

            <?php
            if (Yii::t('app', $model->brand) != '') {

                ?>
                <div><?= Yii::t('app', 'Категория') ?>: <span class="greys"><?= Yii::t('app', $model->brand) ?></span>
                </div>
                <?php
            } ?>

            <!--            //Заказчик -  В эксклюзиве неправильно выводится тип огранки (в т.ч. И в фильтрах): эксклюзив - это ручная огранка, выводится как машинная. Тип огранки вообще лучше не отображать списке в карточки товара эксклюзива (и вообще в камнях)-->
            <!--            <div>--><? //= Yii::t('app', 'Тип огранки') ?><!--: <span-->
            <!--                        class="greys">-->
            <? //= (isset($model->treatment_type) && $model->treatment_type == 2) ? Yii::t('app', 'машинная') : Yii::t('app', 'ручная') ?><!--</span>-->
            <!--            </div>-->


            <div><?= Yii::t('app', 'Размер') ?>,
                мм: <span
                        class="greys">
                                        <?php
                                        // если это круглый камушек, второй размер не вывводим
                                        if (in_array($model->shape0->id_shape, [1, 2, 27, 20, 7])) {
                                            $model->size_w = '0.00';
                                        }
                                        echo number_format($model->size_h, 2, '.', ' ') . (($model->size_w != '0.00') ? ' x ' . number_format($model->size_w, 2, '.', ' ') : '') . (($model->size_d != '0.00') ? ' x ' . number_format($model->size_d, 2, '.', ' ') : '');
                                        ?>
                    </span>
            </div>
            <div><?= Yii::t('app', 'Вес') ?>, карат: <span class="greys"><?= $model->weight ?></span></div>


            <?php
            $atsia_str = '';
            if (isset($model->action)) $atsia_str .= '<nobr>-' . $model->action->price_sale . ' ' . $model->action->price_sale_enum . '</nobr>';

            //            if ($model->costPromo != '0,00') $atsia_str .= $model->costPromo . ' ' . $curr->name_currency;
            //            if ($atsia_str)
            //                echo
            //                    '<div>
            //                Акция: <span class="greys">' . $atsia_str . '</span>
            //            </div>';
            ?>

            <?php
            //            if ($model->exclusive_type) {
            echo '<p>&nbsp;</p>';
            echo '<div>' . ($model->exclusiv_priceper_carat ? Yii::t('app', 'Цена за карат') . ': <span class="greys">' . $model->getCost($model->exclusiv_priceper_carat) . ' ' . $curr->name_currency . '</span>' : '') . '</div>';
            // обычная цена echo '<div>' . Yii::t('app', 'Цена за камень') . ': ' . ($model->exclusiv_priceper_stone ? $model->exclusiv_priceper_stone : ' - ') . '</div>';
            echo '<div>' . ($model->exclusiv_params_colorcryst ? Yii::t('app', 'Другие параметры') . ': <span class="greys">' . $model->exclusiv_params_colorcryst . '</span>' : '') . '</div>';
            //            }


            echo '<div>' . ((isset($model->productDescs->{'country_name_' . Yii::$app->language})
                    AND $model->productDescs->{'country_name_' . Yii::$app->language} != '')
                    ? Yii::t('app', 'Страна происхождения') . ': <span class="greys">' . $model->productDescs->{'country_name_' . Yii::$app->language} . '</span>' : '') . '</div>';

            echo '<div>' . ($model->nabor_sizestones ? Yii::t('app', 'Точные размеры') . ': <span class="greys">' . $model->nabor_sizestones . '</span>' : '') . '</div>';


            echo '<div>' . (isset($model->productDescs->{'nabor_notes_' . Yii::$app->language}) ? Yii::t('app', 'Примечание') . ': <span class="greys">' . $model->productDescs->{'nabor_notes_' . Yii::$app->language} . '</span>' : '') . '</div>';



            if ($model->this_is_nabor AND $model->nabor_numberstones > 1) {
                echo '<p>&nbsp;</p>';
                echo '<div>' . ($model->nabor_numberstones ? Yii::t('app', 'Кол-во камней в наборе, шт') . ': <span class="greys">' . $model->nabor_numberstones . '</span>' : '') . '</div>';


                echo '<div>' . ($model->nabor_weightstones ? Yii::t('app', 'Вес камней в наборе, караты') . ': <span class="greys">' . $model->nabor_weightstones . '</span>' : '') . '</div>';


                // ЭТО СТРИНГ ибо Поменять тип цифрового на текстовый без конвертации валют USD теперь всегда
                // ТОЛЬКО ЕСЛИ КАМНЕЙ больше 1 это поле имеет смысл иначе зачем цену разбивать
                echo '<div>' . ($model->exclusiv_priceper_stone ? Yii::t('app', 'Цена камней поштучно') . ': <span class="greys">' . $model->exclusiv_priceper_stone . ' USD</span>' : '') . '</div>';


                //                echo '<div>' . Yii::t('app', 'Другие параметры набора') . ': ' . ($model->nabor_notes ? $model->nabor_notes : ' - ') . '</div>';
            }
            ?>


        </div>
        <div class="tovFilterInfo">
            <?php
            if (isset($model->action->price_sale) AND $model->action->price_sale == '') {
                echo Yii::t('app', 'Цену уточняйте') . $model->action->price_sale;

            } else if (!$model->cost) {
                echo Yii::t('app', 'Цену уточняйте');

            } else if (isset($model->stock_points) && $model->stock_points > 0) {
                $form = ActiveForm::begin(['action' => '/shop/add', 'method' => 'get']); ?>
                <input type="hidden" name="id" value="<?= $model->id ?>"/>
                <input type="hidden" size="4" name="quantity[<?= $model->id ?>]" value="1"/ class="quantity_exclusive">
                <?php
                echo Html::submitButton(Yii::t('app', 'В корзину'), ['class' => 'btn orderBtn']);
                ActiveForm::end();
                echo '<p class="aralavee">' . Yii::t('app', 'Цена') . ':
            <nobr><span>' . number_format($model->cost, 2, ',', ' ') . ' ' . $curr->name_currency . '</span></nobr>
            </p>';


            } else {
                echo '<span class="nostock">' . Yii::t('app', 'Нет в наличии') . '</span>';
            }

            ?>


        </div>
    </div>
    <!-- .tovarM_right -->

    <div class="clear"></div>
    <div class="descript">


        <?php echo(isset($model->productDescs->{'desc_products_' . Yii::$app->language}) ? $model->productDescs->{'desc_products_' . Yii::$app->language} : ''); ?>
        <br>

        <?php echo(isset($model->productDescs->{'nabor_seo_desc_' . Yii::$app->language}) ? $model->productDescs->{'nabor_seo_desc_' . Yii::$app->language} : ''); ?>
        <br>


    </div>
    <!-- .descript -->
</div><!-- .tovarMainContent -->


<?= $this->render('_greyline') ?>
<!-- .greyLine -->

<div class="clear"></div>

<!--табы с доп товарами и опсианием текущего камня-->
<?= $this->render('_tabs', [
    'model' => $model,
    'simple' => $simple,
]) ?>

<div class="clear"></div>

