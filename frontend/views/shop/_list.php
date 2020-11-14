<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<!--template shop/ index.php / _list.php
ЭТО ШАБЛОН  "ВСЕ КАМНИ"
-->


<div class="catalogBlock">
    <div class="catalogBlockIn">
        <div
            class="cB_img">
            <?= Html::a(Html::img($model->thumb(100, 100, 1)), ['shop/item', 'id' => $model->id], ['class' => '']) ?></div>
        <div class="cB_txt">
            <a href="#">


                <h6><?php
                        echo Html::a(Html::encode($model->typeProduct->name), ['shop/item', 'id' => $model->id], ['class' => '']);
                    ?></h6>
            </a>

            <p><?= $model->colorProduct->{'name_color' . (Yii::$app->language == 'uk' ? '_ua' : '')} ?></p>

        </div>
        <div class="clear"></div>


        <?php
        // если не включен фильтр по цене
        //<br>' . $model->minCost . '
        //if ($model->minCost > 0 AND !isset(Yii::$app->request->get('FilterForm')['priceTo']))
            echo '<div class="cB_price">' . Yii::t('app', 'цены >>') . '</div> '; ?>

    </div>
</div><!-- .catalogBlock -->
