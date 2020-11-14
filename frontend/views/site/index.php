<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\grid\GridView;

$this->title = Yii::t('app','Натуральные драгоценные камни Центури | Купить камни с сертификатом: цены, фото, консультация');

//https://gems.ua/

//
/*if ($seo != NULL AND trim($seo->description) <> '') {
    $this->title = $seo->description;
    $this->registerMetaTag(['name' => 'description', 'content' => $seo->description]);
}*/

//
/*$this->params['breadcrumbs'][] = ['label' => str_replace('-', ' ', ucfirst(yii::$app->controller->action->id)), 'url' => [yii::$app->controller->action->id]];
if ($provider) $this->params['breadcrumbs'][] = ['label' => ucfirst($provider)];*/

/*$this->registerMetaTag(['name' => 'keywords', 'content' => 'live cams']);*/
/*
style="background: url(/pic/slider/0-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;" >
*/
if (preg_match('!image\/webp!si',$_SERVER['HTTP_ACCEPT'])) {define("WEBPIMAGE", (bool)true);} else {define("WEBPIMAGE", (bool)false);}
?>
<a id="preloadMainImage" href="/pages/NaturalCrystals"></a>
<div id="owl-demo" class="owl-carousel main-slider">
    <a href="/pages/NaturalCrystals">
        <div class="item"
             style="background: url(/pic/slider/01-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;">
            <div class="txtSlid"><?= Yii::t('app', 'Цветные и бесцветные бриллианты Swarovski') ?></div>
        </div>
    </a>
    <a href="/pages/JewelryCentury">
        <div class="item"
             style="background: url(/pic/slider/1-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;">
            <div class="txtSlid"><?= Yii::t('app', 'Бриллианты сертифицированные GIA') ?></div>
        </div>
    </a>
    <a href="/pages/FancyColoredDiamond">
        <div class="item"
             style="background: url(/pic/slider/2-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;">
            <div class="txtSlid"><?= Yii::t('app', 'Цветные бриллианты') ?></div>
        </div>
    </a>
    <a href="/pages/RareGems">
        <div class="item"
             style="background: url(/pic/slider/3-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;">
            <div class="txtSlid"><?= Yii::t('app', 'Редкие драгоценные камни') ?></div>
        </div>
    </a>
    <a href="/pages/CertifiedGIAdiamonds">
        <div class="item"
             style="background: url(/pic/slider/41-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIMAGE) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;">
            <div class="txtSlid"><?= Yii::t('app', 'Удовольствие Себе — бешеные деньги Детям!') ?></div>
        </div>
    </a>
</div>

<?= $this->render('/shop/_greyline') ?>

<div class="title"><span><?= Yii::t('app', 'Все драгоценные камни') ?></span></div>
<div class="content clr">
    <div class="stonesRow">
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #ec008c;"><?= Yii::t('app', 'розовый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/s1.png" alt=""><a
                            href="/shop?FilterForm[type]=30&FilterForm[color]=2"><?= Yii::t('app', 'турмалин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s2.png" alt=""><a
                            href="/shop?FilterForm[type]=12&FilterForm[color]=2"><?= Yii::t('app', 'гранат') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s3.png" alt=""><a
                            href="/shop?FilterForm[type]=4&FilterForm[color]=2"><?= Yii::t('app', 'сапфир') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s4.png" alt=""><a
                            href="/shop?FilterForm[type]=9&FilterForm[color]=2"><?= Yii::t('app', 'топаз') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s5.png" alt=""><a
                            href="/shop?FilterForm[type]=42&FilterForm[color]=2"><?= Yii::t('app', 'кунцит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s6.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=2"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=2"><img data-src="/pic/pink.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #ff0033;"><?= Yii::t('app', 'красный') ?></p></li>
                <li><img data-src="/pic/stoneCircle/s7.png" alt=""><a
                            href="/shop?FilterForm[type]=5&FilterForm[color]=1"><?= Yii::t('app', 'рубин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s8.png" alt=""><a
                            href="/shop?FilterForm[type]=30&FilterForm[color]=1"><?= Yii::t('app', 'турмалин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s9.png" alt=""><a
                            href="/shop?FilterForm[type]=12&FilterForm[color]=1"><?= Yii::t('app', 'гранат') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s10.png" alt=""><a
                            href="/shop?FilterForm[type]=32&FilterForm[color]=1"><?= Yii::t('app', 'шпинель') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=1"><img data-src="/pic/red.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #ff6633;"><?= Yii::t('app', 'оранжевый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/s11.png" alt=""><a
                            href="/shop?FilterForm[type]=4&FilterForm[color]=7"><?= Yii::t('app', 'сапфир') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s12.png" alt=""><a
                            href="/shop?FilterForm[type]=9&FilterForm[color]=7"><?= Yii::t('app', 'топаз') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=7"><img data-src="/pic/orange.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #ffcc00;"><?= Yii::t('app', 'жёлтый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/s13.png" alt=""><a
                            href="/shop?FilterForm[type]=4&FilterForm[color]=5"><?= Yii::t('app', 'сапфир') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s14.png" alt=""><a
                            href="/shop?FilterForm[type]=7&FilterForm[color]=5"><?= Yii::t('app', 'цитрин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/s15.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=5"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=5"><img data-src="/pic/yellow.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
    </div>
    <!-- .stonesRow -->
    <div class="stonesRow">
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #3FB6AC;"><?= Yii::t('app', 'зелёный') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss1.png" alt=""><a
                            href="/shop?FilterForm[type]=1&FilterForm[color]=4"><?= Yii::t('app', 'агат') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss2.png" alt=""><a
                            href="/shop?FilterForm[type]=6&FilterForm[color]=4"><?= Yii::t('app', 'изумруд') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss3.png" alt=""><a
                            href="/shop?FilterForm[type]=2&FilterForm[color]=4"><?= Yii::t('app', 'александрит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss4.png" alt=""><a
                            href="/shop?FilterForm[type]=30&FilterForm[color]=4"><?= Yii::t('app', 'турмалин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss5.png" alt=""><a
                            href="/shop?FilterForm[type]=16&FilterForm[color]=4"><?= Yii::t('app', 'демантоид') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss6.png" alt=""><a
                            href="/shop?FilterForm[type]=31&FilterForm[color]=4"><?= Yii::t('app', 'цаворит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss7.png" alt=""><a
                            href="/shop?FilterForm[type]=8&FilterForm[color]=4"><?= Yii::t('app', 'хризолит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss8.png" alt=""><a
                            href="/shop?FilterForm[type]=10&FilterForm[color]=4"><?= Yii::t('app', 'аметист') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=4"><img data-src="/pic/green.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #95D8F7;"><?= Yii::t('app', 'голубой') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss9.png" alt=""><a
                            href="/shop?FilterForm[type]=30&FilterForm[color]=3"><?= Yii::t('app', 'турмалин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss10.png" alt=""><a
                            href="/shop?FilterForm[type]=9&FilterForm[color]=3"><?= Yii::t('app', 'топаз') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss11.png" alt=""><a
                            href="/shop?FilterForm[type]=22&FilterForm[color]=3"><?= Yii::t('app', 'аквамарин') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss11.png" alt=""><a
                            href="/shop?FilterForm[type]=21&FilterForm[color]=3"><?= Yii::t('app', 'опал') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=3"><img data-src="/pic/blue_.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #2802D0;"><?= Yii::t('app', 'синий') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss12.png" alt=""><a
                            href="/shop?FilterForm[type]=4&FilterForm[color]=11"><?= Yii::t('app', 'сапфир') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss13.png" alt=""><a
                            href="/shop?FilterForm[type]=19&FilterForm[color]=11"><?= Yii::t('app', 'танзанит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss14.png" alt=""><a
                            href="/shop?FilterForm[type]=32&FilterForm[color]=11"><?= Yii::t('app', 'шпинель') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss15.png" alt=""><a
                            href="/shop?FilterForm[type]=43&FilterForm[color]=11"><?= Yii::t('app', 'кианит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss15.png" alt=""><a
                            href="/shop?FilterForm[type]=9&FilterForm[color]=11"><?= Yii::t('app', 'топаз') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=11"><img data-src="/pic/dark_blue.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #8455A4;"><?= Yii::t('app', 'фиолетовый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss16.png" alt=""><a
                            href="/shop?FilterForm[type]=10&FilterForm[color]=6"><?= Yii::t('app', 'аметист') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss17.png" alt=""><a
                            href="/shop?FilterForm[type]=32&FilterForm[color]=6"><?= Yii::t('app', 'шпинель') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=6"><img data-src="/pic/fiolet.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
    </div>
    <!-- .stonesRow -->
    <div class="stonesRow">

        <div class="stoneBlock">
            <ul>
                <li><p style="color: #8A7158;"><?= Yii::t('app', 'коричневый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss21.png" alt=""><a
                            href="/shop?FilterForm[type]=13&FilterForm[color]=9"><?= Yii::t('app', 'бриллиант') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss22.png" alt=""><a
                            href="/shop?FilterForm[type]=38&FilterForm[color]=9"><?= Yii::t('app', 'циркон') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss23.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=9"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss24.png" alt=""><a
                            href="/shop?FilterForm[type]=48&FilterForm[color]=9"><?= Yii::t('app', 'кварц-волосатик') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss18.png" alt=""><a
                            href="/shop?FilterForm[type]=50"><?= Yii::t('app', 'раухтопаз') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss19.png" alt=""><a
                            href="/shop?FilterForm[type]=50"><?= Yii::t('app', 'дымчатый кварц') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=9"><img data-src="/pic/braun.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #606060;"><?= Yii::t('app', 'серый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss20.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=13"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>


            </ul>
            <a href="/shop?FilterForm[color]=13"><img data-src="/pic/grey.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #fff; text-shadow: 0 0 2px #000"><?= Yii::t('app', 'белый') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss25.png" alt=""><a
                            href="/shop?FilterForm[type]=13&FilterForm[color]=8"><?= Yii::t('app', 'бриллиант') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss26.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=8"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss27.png" alt=""><a
                            href="/shop?FilterForm[type]=4&FilterForm[color]=8"><?= Yii::t('app', 'сапфир') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss28.png" alt=""><a
                            href="/shop?FilterForm[type]=9&FilterForm[color]=8"><?= Yii::t('app', 'топаз') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=8"><img data-src="/pic/white.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #0E0E0E;"><?= Yii::t('app', 'чёрный') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss29.png" alt=""><a
                            href="/shop?FilterForm[type]=13&FilterForm[color]=10"><?= Yii::t('app', 'бриллиант') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss30.png" alt=""><a
                            href="/shop?FilterForm[type]=32&FilterForm[color]=10"><?= Yii::t('app', 'шпинель') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss31.png" alt=""><a
                            href="/shop?FilterForm[type]=14&FilterForm[color]=10"><?= Yii::t('app', 'жемчуг') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=10"><img data-src="/pic/black.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->
        <div class="stoneBlock">
            <ul>
                <li><p style="color: #0F0F0F;"><?= Yii::t('app', 'мультиколор') ?></p></li>
                <li><img data-src="/pic/stoneCircle/ss32.png" alt=""><a
                            href="/shop?FilterForm[type]=2&FilterForm[color]=12"><?= Yii::t('app', 'александрит') ?></a>
                </li>
                <li><img data-src="/pic/stoneCircle/ss33.png" alt=""><a
                            href="/shop?FilterForm[type]=21&FilterForm[color]=12"><?= Yii::t('app', 'опал') ?></a>
                </li>
            </ul>
            <a href="/shop?FilterForm[color]=12"><img data-src="/pic/multicolor.<? if (WEBPIMAGE) {echo "webp";} else {echo "png";} ?>" class="stoneImg" alt=""></a>
        </div>
        <!-- .stoneBlock -->

    </div>
    <!-- .stonesRow -->
    <a href="/shop" class="more_gems"><?= Yii::t('app', 'еще камни') ?> >></a>

</div><!-- .content -->
<div class="title"><span><div class="title"><span><?= Yii::t('app', 'Выберите камни') ?></span></div></span></div>
<div class="content clr">
    <div class="chooseBlock cut">
        <h5><?= Yii::t('app', 'по огранке') ?></h5>
        <ul>
            <li><a href="/shop?FilterForm[shape]=1"><img data-src="/pic/cut/c1.png" alt=""><?= Yii::t('app', 'Круг') ?></a>
            </li>
            <li><a href="/shop?FilterForm[shape]=3"><img data-src="/pic/cut/c2.png" alt=""><?= Yii::t('app', 'Квадрат') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=6"><img data-src="/pic/cut/c3.png" alt=""><?= Yii::t('app', 'Октагон') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=12"><img data-src="/pic/cut/c4.png" alt=""><?= Yii::t('app', 'Багет') ?></a>
            </li>
            <li><a href="/shop?FilterForm[shape]=10"><img data-src="/pic/cut/c5.png" alt=""><?= Yii::t('app', 'Овал') ?></a>
            </li>
        </ul>
        <ul>
            <li><a href="/shop?FilterForm[shape]=9"><img data-src="/pic/cut/c6.png" alt=""><?= Yii::t('app', 'Груша') ?></a>
            </li>
            <li><a href="/shop?FilterForm[shape]=13"><img data-src="/pic/cut/c7.png" alt=""><?= Yii::t('app', 'Маркиз') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=11"><img data-src="/pic/cut/c8.png" alt=""><?= Yii::t('app', 'Сердце') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=5"><img data-src="/pic/cut/c9.png" alt=""><?= Yii::t('app', 'Триллион') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=14"><img data-src="/pic/cut/c10.png"
                                                          alt=""><?= Yii::t('app', 'Треугольник') ?></a></li>
        </ul>
        <ul>
            <li><a href="/shop?FilterForm[shape]=7"><img data-src="/pic/cut/c11.png" alt=""><?= Yii::t('app', 'Пуговица') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=21"><img data-src="/pic/cut/c12.png" alt=""><?= Yii::t('app', 'Кушон') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=27"><img data-src="/pic/cut/c13.png" alt=""><?= Yii::t('app', 'Португал') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=22"><img data-src="/pic/cut/c14.png" alt=""><?= Yii::t('app', 'Сфера') ?>
                </a></li>
            <li><a href="/shop?FilterForm[shape]=31"><img data-src="/pic/cut/c15.png" alt=""><?= Yii::t('app', 'Другие') ?>
                </a></li>
        </ul>
    </div>
    <!-- .chooseBlock -->
    <div class="chooseBlock">
        <h5><?= Yii::t('app', 'по бренду') ?></h5>

        <div class="brend">
            <!--            btit swar-->
            <div class="btit swar"><a
                        href="/shop?FilterForm[brand]=%D0%9A%D0%B0%D0%BB%D0%B8%D0%B1%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%BD%D1%8B%D0%B5%20%D0%B2%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B8%20Swarovski%20gemstones">Swarovski
                    Gemstones</a></div>
            <p><?= Yii::t('app', 'Калиброванные натуральные вставки мелких размеров. Безупречная машинная огранка') ?>
                .</p>
        </div>
        <div class="brend">
            <div class="btit mode"><a
                        href="/shop?FilterForm%5Bbrand%5D=Модельные%20камни"><?= Yii::t('app', 'Модельные камни') ?></a>
            </div>
            <p>
                .<?= Yii::t('app', 'Натуральные камни средних размеров (от 2-4 до 16 мм и более). Огранка производится вручную') ?></p>
        </div>
    </div>
    <!-- .chooseBlock -->
    <div class="chooseBlock zodiac">
        <h5><?= Yii::t('app', 'по гороскопу') ?></h5>
        <ul>
            <li><a class="z1" href="/pages/oven"><?= Yii::t('app', 'Овен') ?></a></li>
            <li><a class="z2" href="/pages/telets"><?= Yii::t('app', 'Телец') ?></a></li>
            <li><a class="z3" href="/pages/bliznetsy"><?= Yii::t('app', 'Близнецы') ?></a></li>
            <li><a class="z4" href="/pages/rak"><?= Yii::t('app', 'Рак') ?></a></li>
        </ul>
        <ul>
            <li><a class="z5" href="/pages/lev"><?= Yii::t('app', 'Лев') ?></a></li>
            <li><a class="z6" href="/pages/deva"><?= Yii::t('app', 'Дева') ?></a></li>
            <li><a class="z7" href="/pages/vesy"><?= Yii::t('app', 'Весы') ?></a></li>
            <li><a class="z8" href="/pages/skorpion"><?= Yii::t('app', 'Скорпион') ?></a></li>
        </ul>
        <ul>
            <li><a class="z9" href="/pages/strelets"><?= Yii::t('app', 'Стрелец') ?></a></li>
            <li><a class="z10" href="/pages/kozerog"><?= Yii::t('app', 'Козерог') ?></a></li>
            <li><a class="z11" href="/pages/vodoley"><?= Yii::t('app', 'Водолей') ?></a></li>
            <li><a class="z12" href="/pages/rybi"><?= Yii::t('app', 'Рыбы') ?></a></li>
        </ul>


    </div>
    <!-- .chooseBlock -->
</div><!-- .content -->
<div class="title"><span><?= Yii::t('app', 'Новинки') ?></span></div>
<div class="content">
    <div class="newSlider">
        <?= ListView::widget([
            'dataProvider' => $new,
            'itemView' => '@app/views/shop/_list_gem',
            'viewParams' => ['shape' => 1],
            'options' => [
                'tag' => 'ul',
                'id' => 'newSl'
            ],
            'itemOptions' => [
                'tag' => 'li',
            ],
            'layout' => "{items}",
        ]); ?>

        <button type="button" id="nPrev"></button>
        <button type="button" id="nNext"></button>
    </div>
</div><!-- .content -->


<!-- смотри рядом файл с вкладками вынес -->
<!-- смотри рядом файл с вкладками вынес -->
<!-- смотри рядом файл с вкладками вынес -->
<!-- смотри рядом файл с вкладками вынес -->
<!-- смотри рядом файл с вкладками вынес -->
<!-- смотри рядом файл с вкладками вынес -->


<div class="title"><span><?= Yii::t('app', 'Gems — интернет-магазин натуральных драгоценных камней') ?></span></div>
<div class="content read">

    <?php
    // редактировать этот блок здесь
    // http://g.new-dating.com/admin/pages/update?id=30
    $modelPages = \common\models\Pages::find()->where(['id' => 30])->one();
    echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};

    ?>

    <div class="readMore"><span><a href="#"><?= Yii::t('app', 'Читать дальше') ?></a></span></div>
</div><!-- .content -->


<!--<div class="site-index" >-->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>--><? //=Yii::t('app', 'Список типов камней по группам цветов')?><!--</h2>-->
<!--        --><? //= ListView::widget([
//            'dataProvider' => $types,
//            'itemView' => '@app/views/shop/_list',
//            'layout' => "<div class='gems-list'>{items}</div>{pager}",
//
//        ]); ?>
<!--    </div>-->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>--><? //=Yii::t('app', 'Все камни')?><!--</h2>-->
<!--        <ul>-->
<!--            --><?php
//            $types = \common\models\ProductType::find()->orderBy('name_product_type')->all();
//            foreach ($types as $type) {
//                echo '<li><a href="/shop?FilterForm[type]=' . $type->id_product_type . '">' . $type->name . '</a></li>';
//            }
//            ?>
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>--><? //=Yii::t('app', 'Цвета')?><!--</h2>-->
<!--        <ul>-->
<!--            --><?php
//            $types = \common\models\ProductsColorGroup::find()->orderBy('name_color_group')->all();
//            foreach ($types as $type) {
//                echo '<li><a href="/shop?FilterForm[color]=' . $type->id_color_group . '">' . $type->name . '</a></li>';
//            }
//            ?>
<!--        </ul>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>--><? //=Yii::t('app', 'Акции')?><!--</h2>-->
<!--        <ul>-->
<!--            --><?php
//            echo '<li><a href="/shop?FilterForm[action]=1">'.Yii::t('app', 'Акции').'</a></li>';
//            ?>
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>--><? //=Yii::t('app', 'Эксклюзив')?><!--</h2>-->
<!--        <ul>-->
<!--            --><?php
//            echo '<li><a href="/shop?FilterForm[exclusive]=1">'.Yii::t('app', 'Эксклюзив').'</a></li>';
//            ?>
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div class="clearfix">-->
<!--        <h2>SWAROVSKI ZIRCONIA</h2>-->
<!--        <ul>-->
<!--            --><?php
//            echo '<li><a href="/shop?FilterForm[synthetic]=1">SWAROVSKI ZIRCONIA</a></li>';
//            ?>
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->
