<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$curr = Yii::$app->currency->getCurrency();

?>
<!--template shop/ index.php / _list_simple.php-->
<li>
    <p><a href="/simpleproducts"><?=$model->{'name'.(Yii::$app->language == 'uk' ? '_ua' : '')}?></a></p>
    <div class="aboutStoneImg"><img src="<?=$model->img?>" alt=""></div>
    <p><?=number_format($model->cost, 2, ',', ' ')?> <?= $curr->name_currency?></p>
    <a href="/shop/buy?id=<?=$model->id_simpleproduct?>&type=simple" class="buyBtn"><?=Yii::t('app', 'Купить вместе')?></a>

</li>
<!-- .tabBlock -->
