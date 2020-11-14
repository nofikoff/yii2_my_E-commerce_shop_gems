<?php
use yii\helpers\Html;

$this->beginPage();

if (preg_match('!image\/webp!si',$_SERVER['HTTP_ACCEPT'])) {define("WEBPIC", (bool)true);} else {define("WEBPIC", (bool)false);}
if (preg_match('!gems\.ua!si',$_SERVER['SERVER_NAME'])) {$donorsite = $_SERVER['SERVER_NAME'];} else {$donorsite = 'gems.ua';}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {define("DONORSITE", 'https://'.$donorsite.'/');} else {define("DONORSITE", 'http://'.$donorsite.'/');}
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113857776-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-113857776-1');
    </script>


    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<?php
/* Оригинальные файлы подключить
@font-face {
    font-family: 'Cuprum';
    src: url('<? echo DONORSITE; ?>fonts/icomoon.eot?7mxeik');
    src: url('<? echo DONORSITE; ?>fonts/icomoon.eot?7mxeik#iefix') format('embedded-opentype'),
        url('<? echo DONORSITE; ?>fonts/icomoon.woff?7mxeik') format('woff'),
        url('<? echo DONORSITE; ?>fonts/icomoon.ttf?7mxeik') format('truetype'),
        url('<? echo DONORSITE; ?>fonts/icomoon.svg?7mxeik#icomoon') format('svg');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
*/
?>
<style>
@font-face {
    font-family: 'Cuprum';
    src: url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.eot?v=4.7.0');
    src: url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'),
        url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'),
        url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'),
        url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'),
        url('<? echo DONORSITE; ?>fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
@font-face {
    font-family: 'Cuprum Bold';
    src: url('<? echo DONORSITE; ?>css/fonts/cuprum-bold.eot');
    src: url('<? echo DONORSITE; ?>css/fonts/cuprum-bold.eot?#iefix') format('embedded-opentype'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-bold.woff') format('woff'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-bold.ttf') format('truetype'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-bold.svg#Cuprum Bold') format('svg');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
@font-face {
    font-family: 'Cuprum';
    src: url('<? echo DONORSITE; ?>css/fonts/cuprum-regular.eot');
    src: url('<? echo DONORSITE; ?>css/fonts/cuprum-regular.eot?#iefix') format('embedded-opentype'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-regular.woff') format('woff'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-regular.ttf') format('truetype'),
    url('<? echo DONORSITE; ?>css/fonts/cuprum-regular.svg#Cuprum') format('svg');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
</style>
    <?php $this->head() ?>

<script type="text/javascript">
(function() {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = 'js/extsrc-min.js';
    document.getElementsByTagName('head')[0].appendChild(script);
})();
</script>

<style>
#preloadMainImage{
    background: url(/pic/slider/01-banner-gems-ua-<?= Yii::$app->language ?>.<? if (WEBPIC) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;
    display: none;
}
:root{
    --width: calc(100vw - 30px);
}
#sticky-filter{
    display: none;
}
#owllego{
    width: calc(100vw - 30px);
    min-height: 30vw;
    height:  calc(var(--width)*0.4 + 40px);
    margin: 0px auto;
    display:block;
    overflow:hidden;
}
.owl-carousel{
    margin-bottom:0px !important;
}
a.button7 {
    font-weight: 700;
    color: white;
    text-decoration: none;
    padding: .8em 1em calc(.8em + 3px);
    border-radius: 3px;
    background: rgb(64,199,129);
    box-shadow: 0 -3px rgb(53,167,110) inset;
    transition: 0.2s;
}
a.button7:hover { background: rgb(53, 167, 110); }
a.button7:active {
    background: rgb(33,147,90);
    box-shadow: 0 3px rgb(33,147,90) inset;
}
.field-orders-name input, .field-orders-phone input{
    background: linear-gradient(to top, #e8bdce 0%, #fff 36%);
    color: #000;
    border: 1px solid #333;
    border-radius: 20px;
}
.thumbs li img {
  display: inline-block;
    vertical-align: middle;
    height: auto;
/*    display: block;*/
    max-width: 100%;
    max-height: 100%;
}
ul#thumbs{
    width:100%;
}
.thmubs{
    width:auto;
}

.myfb02{
    width:49%;
    padding: 1% 0;
/*    position: relative;
    top: -45px;
    float: right;
    margin-top: -45px; */
}
.fb_iframe_widget { float: right; }
.prebread{
        width: 45%;
}
.fb_iframe_widget iframe { margin-top: 0px;}

@media only screen and (max-width: 992px){
    .topHead{
        display:none;
    }
    .botHead{
        display:flex;
        height:107px;
    }
    .greyLine {
        display:flex;
        width:95%
    }
    .myfb, .myfb01{
        margin-bottom: 10px;
    }
}
@media only screen and (max-width: 720px){
    #preloadMainImage{
        background:  url(/pic/slider/01-banner-gems-ua-<?= Yii::$app->language ?>-720px.<? if (WEBPIC) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;
    }

}
@media only screen and (max-width: 550px){
    #preloadMainImage{
        background:  url(/pic/slider/01-banner-gems-ua-<?= Yii::$app->language ?>-550px.<? if (WEBPIC) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;
    }

}
@media only screen and (max-width: 420px){
    #preloadMainImage{
        background:  url(/pic/slider/01-banner-gems-ua-<?= Yii::$app->language ?>-420px.<? if (WEBPIC) {echo "webp";} else {echo "jpg";} ?>) no-repeat center center;
        display: block;
        width: calc(100vw - 30px);
        min-height: 30vw;
        height:  calc(var(--width)*0.4 + 40px);
        margin: 0px auto;
        background-size: contain;
    }
    .botHead{
        height: 90px;
    }
    .nav, #owl-demo{
        display:none;
    }
    .topHead{
        display:none;
    }
    .myfb, .myfb02{
        margin-bottom: 15px;
        float:none;
    }
    .myfb02{
        position: relative;
        margin-top: 10px;
        width:100%;
    }
    .prebread{
        width: 100%;
    }

    #sticky-filter{
        width: 100%;
        display: block;
        visibility: visible;
        height:49px;
        z-index:100;
    }
    .leftBlock{
        position: absolute;
        left:-300px;
        z-index: 200;
    }
    .rightBlock{
        width:100%;
    }
    .thumbs{
        width:45vw;
    }

}
</style>

<noscript><link type="text/css" href="css/colorbox.css" rel="stylesheet" /></noscript>
<noscript><link type="text/css" href="css/styleB7265b.css" rel="stylesheet" /></noscript>
<noscript><link type="text/css" href="css/mediaA3265b.css" rel="stylesheet" /></noscript>
<noscript><link type="text/css" href="css/font-awesome-min.css" rel="stylesheet" /></noscript>
<noscript><link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet" /></noscript>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ document.jivositeloaded=0;var widget_id = 'bITrzLstZS';var d=document;var w=window;function l(){var s = d.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}//эта строка обычная для кода JivoSite
function zy(){
    //удаляем EventListeners
    if(w.detachEvent){//поддержка IE8
        w.detachEvent('onscroll',zy);
        w.detachEvent('onmousemove',zy);
        w.detachEvent('ontouchmove',zy);
        w.detachEvent('onresize',zy);
    }else {
        w.removeEventListener("scroll", zy, false);
        w.removeEventListener("mousemove", zy, false);
        w.removeEventListener("touchmove", zy, false);
        w.removeEventListener("resize", zy, false);
    }
    //запускаем функцию загрузки JivoSite
    if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}
    //Устанавливаем куку по которой отличаем первый и второй хит
    var cookie_date = new Date ( );
    cookie_date.setTime ( cookie_date.getTime()+60*60*28*1000); //24 часа для Москвы
    d.cookie = "JivoSiteLoaded=1;path=/;expires=" + cookie_date.toGMTString();
}
if (d.cookie.search ( 'JivoSiteLoaded' )<0){//проверяем, первый ли это визит на наш сайт, если да, то назначаем EventListeners на события прокрутки, изменения размера окна браузера и скроллинга на ПК и мобильных устройствах, для отложенной загрузке JivoSite.
    if(w.attachEvent){// поддержка IE8
        w.attachEvent('onscroll',zy);
        w.attachEvent('onmousemove',zy);
        w.attachEvent('ontouchmove',zy);
        w.attachEvent('onresize',zy);
    }else {
        w.addEventListener("scroll", zy, {capture: false, passive: true});
        w.addEventListener("mousemove", zy, {capture: false, passive: true});
        w.addEventListener("touchmove", zy, {capture: false, passive: true});
        w.addEventListener("resize", zy, {capture: false, passive: true});
    }
}else {zy();}
})();</script>
<!-- {/literal} END JIVOSITE CODE -->

    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 802814030;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script async type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt=""
                 src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/802814030/?guid=ON&script=0"/>
        </div>
    </noscript>

    <meta name="description"
          content="Купить драгоценные камни легко: Центури на рынке с 2002 года! ① Самый большой склад в Украине ✓Сапфир, рубин, изумруд ✓Бриллиант ✓Жемчуг, шпинель, турмалин, танзанит и др.✓Огранка камней"/>

    <meta property="og:type" content="website">
    <meta property="og:title" content="Натуральные драгоценные камни Центури | Купить камни с сертификатом: цены, фото, консультация">
    <meta property="og:description"
          content="Купить драгоценные камни легко: Центури на рынке с 2002 года! ① Самый большой склад в Украине ✓Сапфир, рубин, изумруд ✓Бриллиант ✓Жемчуг, шпинель, турмалин, танзанит и др.✓Огранка камней">
    <meta property="og:url" content="https://gems.ua/">
    <meta property="og:image" content="https://gems.ua/images/gems_og.png">

    <!-- Facebook Pixel Code -->
    <!-- Facebook Pixel Code -->
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '600632814077872');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=600632814077872&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <!-- End Facebook Pixel Code -->
    <!-- End Facebook Pixel Code -->


<?php
   $currentUri = '/' . trim(preg_replace('~/' . Yii::$app->language . '/~', '', \yii\helpers\Url::current()), '/');
   $currentUri = preg_replace('~site\/index~', '', $currentUri );
   $currentUri = preg_replace('~index~', '', $currentUri );
   

?>
<link rel="canonical" href="https://gems.ua<?=$currentUri?>" />
<link rel="alternate" hreflang="uk" href="https://gems.ua<?=$currentUri?>" />
<link rel="alternate" hreflang="ru" href="https://gems.ua/ru<?=$currentUri?>" />




</head>
<body>
<?php $this->beginBody() ?>

<section class="size" style="height: auto!important;min-height: 100px;">


    <header>
        <div class="topHead">
            <ul>
                <li><a href="/pages/about"><?= Yii::t('app', 'О нас') ?></a></li>
                <li><a href="/pages/payment"><?= Yii::t('app', 'Доставка и оплата') ?></a></li>
                <li><a href="/pages/sertificate"><?= Yii::t('app', 'Сертификация') ?></a></li>
                <li><a href="/pages/ArticlesGemstones"><?= Yii::t('app', 'Статьи') ?></a></li>
                <!--                <li><a href="/pages/questions"><?= Yii::t('app', 'Вопросы') ?></a></li>-->
                <!--                <li><a href="/pages/reviews"><?= Yii::t('app', 'Отзывы') ?></a></li>-->
                <li><a href="/pages/contacts"><?= Yii::t('app', 'Контакты') ?></a></li>
            </ul>
            <div class="topHead_right">
                <div class="lang hidd">
                    <?php
                    $currentUri = '/' . trim(preg_replace('~/' . Yii::$app->language . '/~', '', \yii\helpers\Url::current()), '/');
                    echo '<a id="ru" href="/ru' . $currentUri . '" class="' . (Yii::$app->language == 'ru' ? 'cur' : '') . ' hidd">RU</a>
                  <a href="/ru' . $currentUri . '" class="hidden la"><img data-src="/pic/ru.png" alt=""></a>
                  <span class="hidd">/</span>';
                    echo '<a href="/uk' . $currentUri . '" id="ua" class="' . (Yii::$app->language == 'uk' ? 'cur' : '') . ' hidd">UA</a>
                  <a href="/uk' . $currentUri . '" class="hidden la"><img data-src="/pic/uk.png" alt=""></a>';
                    ?>
                </div>

                <div class="username">
                    <?php
                    if (Yii::$app->user->isGuest) {
//                        echo '<a href="/site/signup" class="enterLink2 hidd">' . Yii::t('app', 'Регистрация') . '</a>';
                        echo '<a href="/site/login" class="enterLink hidd">' . Yii::t('app', 'Вход') . '</a>';
                        echo '</div>';
                    } else {
                        echo '<a href="/shop/user" class="enterLink2 hidd">' . Yii::$app->user->identity->username . '</a>';
                        echo '</div>';

                        echo '<div class="buttonlogout">'
                            . \yii\helpers\Html::beginForm(['/site/logout'], 'post')
                            . \yii\helpers\Html::submitButton(
                                Yii::t('app', 'Выход'),
                                ['class' => 'enterLink hidd']
                            )
                            . \yii\helpers\Html::endForm()
                            . '';
                        echo '</div>';

                    }

                    ?>
                </div>
                <!-- .topHead_right -->
                <div class="clear"></div>
            </div>
            <!-- .topHead -->
            <div class="botHead">
                <span class="mob_mnu"><i class="fa fa-bars"></i></span>
                <a href="/" class="logo ">
                <picture>
                    <? $s = Yii::$app->language;
                    if (preg_match('!ru!si',$s)) { ?>
                        <source type="image/webp" media="(max-width: 400px)" srcset="/pic/logo_ru-min.webp">
                        <source type="image/png" media="(max-width: 400px)" srcset="/pic/logo_ru-min.png">
                        <source type="image/webp" media="(min-width: 401px)" srcset="/pic/logo_ru.webp">
                        <source type="image/png" media="(min-width: 401px)" srcset="/pic/logo_ru.png">
                        <img src="/pic/logo_ru.png" alt="gems">
                    <? } else { ?>
                        <source type="image/webp" media="(max-width: 400px)" srcset="/pic/logo_ua-min.webp">
                        <source type="image/png" media="(max-width: 400px)" srcset="/pic/logo_ua-min.png">
                        <source type="image/webp" media="(min-width: 401px)" srcset="/pic/logo_ua.webp">
                        <source type="image/png" media="(min-width: 401px)" srcset="/pic/logo_ua.png">
                        <img src="/pic/logo_ru.png" alt="gems">
                    <? }?>
                </picture>
                </a>
                <div class="searchBlock">
                    <div class="phoneBlock">
                        <p>(044) 592-14-88</p>

                        <p>(050) 207-75-54</p>

                        <div class="feedback hidd"><?= Yii::t('app', 'Обратный звонок') ?></div>

                    </div>
                    <div class="feedback_popup">
                        <div class="feedback_inner">
                            <span class="close"><i class="fa fa-times-circle" aria-hidden="true"></i></span>

                            <p><?= Yii::t('app', 'Мы свяжемся с Вами') ?>!</p>

                            <p class="small"><?= Yii::t('app', 'Оставьте свои') ?>:</p>
                            <ul class="errors">
                                <li class="phone_error"></li>
                            </ul>
                            <form action="<?= \yii\helpers\Url::to(['/backcall/send']) ?>" method="POST">
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                                           value="<?= Yii::$app->request->csrfToken; ?>"/>
                                    <?php
                                    //$currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language) + 1);
                                    echo \yii\helpers\Html::hiddenInput('successUrl', $currentUri);
                                    ?>


                                <input class="input" type="text" name="name"
                                           placeholder="<?= Yii::t('app', 'Имя') ?>">
                                <input class="input" type="text" name="phone" id="phone"
                                           placeholder="<?= Yii::t('app', 'Номер телефона') ?>">
                                <input class="submit" type="submit" name="submit"
                                           value="<?= Yii::t('app', 'Отправить') ?>">
                            </form>
                        </div>
                    </div>
                    <span class="search_butt hidden">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>

                    <form action="/shop" method="GET" class="searchForm">
                        <input type="text" class="search_input" name="FilterForm[key]"
                               placeholder="<?= Yii::t('app', 'Введите запрос') ?>">
                        <input type="submit" class="search_but" value="<?= Yii::t('app', 'Найти') ?>">
                    </form>
                </div>
                <!-- .searchBlock -->
                <div class="botHead_right">
                    <div class="wish_box hiddenn"><a href="#">Шкатулка желаний</a></div>
                    <div class="basket">
                        <a href="/shop/cart">
                    <span class="hidd"><?= Yii::t('app', 'Моя корзина') ?>: <span>

                            <?php
                            if (\Yii::$app->cart->getCount() == 0) echo Yii::t('app', 'пуста');
                            else echo \Yii::$app->cart->getCount() . " шт.";
                            ?>

                        </span></span>
                        </a>
                    </div>
                    <div class="valuta">
                        <p><?= Yii::t('app', 'Выбор валюты') ?>:</p>
                        <!--                <div class="currencies">-->
                        <?php
                        //$currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language) + 1);
                        $curr = Yii::$app->currency->getCurrency();
                        $currency = \common\models\Currencies::find()->all();
                        //                    $currencies = \common\models\Currencies::find()->all();
                        //                    foreach ($currencies as $currency) {
                        //                        echo '<a class="'.($curr->code_currency == $currency->code_currency?'active':'').'" href="/site/currencies?code='.$currency->code_currency.'&destination='.$currentUri.'">'.$currency->code_currency.'</a>   ';;
                        //                    }
                        //                        echo $curr->course_currency;
                        //                        exit;
                        $UAH = number_format(1 / $currency[1]->course_currency, 2, ',', ' ');
                        echo '<a class="' . ($curr->code_currency == $currency[0]->code_currency ? 'active' : '') . '" href="/site/currencies?code=' . $currency[0]->code_currency . '&destination=' . $currentUri . '">1 ' . $currency[0]->name_currency . '</a>  / ';;
                        echo '<a class="' . ($curr->code_currency == $currency[1]->code_currency ? 'active' : '') . '" href="/site/currencies?code=' . $currency[1]->code_currency . '&destination=' . $currentUri . '">' . $UAH . ' ' . $currency[1]->name_currency . '</a>   ';;
                        ?>
                        <!--                </div>-->
                        <!--  <select class="sel">
                    <?php
                        /*                    $currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language) + 1);
                                            $curr = Yii::$app->currency->getCurrency();
                                            $currencies = \common\models\Currencies::find()->all();
                                            foreach ($currencies as $currency) {
                                                echo '<option ' . ($curr->code_currency == $currency->code_currency ? 'selected' : '') . ' value="' . $currency->code_currency . '">' . $currency->code_currency . '</option>';
                                            }


                                            */ ?>
                </select>-->
                    </div>
                </div>
                <!-- .botHead_right -->
                <div class="clear"></div>
            </div>
            <!-- .botHead -->
            <div id="PopupJava" class="mainMenu_popup">
                <div class="main-menu__close"></div>
                <div class="main-menu__popup"></div>
                <div class="mnu_steps">
                    <div class="mnu_step" id="mnu_s1">
                        <div class="cont_row">
                            <img class="img_row_cont" data-src="/pic/icon2.png" alt="Phone">
                            <span class="text_row_cont"><a href="tel:(044) 592-14-88" style="text-decoration: none">044 592 14 88</a></span>
                        </div>
                        <div class="cont_row">
                            <img class="img_row_cont" data-src="/pic/icon3.png" alt="Vodafone">
                            <span class="text_row_cont"><a href="tel:(050) 207-75-54" style="text-decoration: none">050 207 75 54</a></span>
                        </div>
                        <div class="cont_row">
                            <img class="img_row_cont" data-src="/pic/icon1.png" alt="Mobile">
                            <span class="text_row_cont"><a href="tel:(068)660-68-09" style="text-decoration: none">(068) 660-68-09</a></span>
                        </div>
                        <div class="cont_row">
                            <img class="img_row_cont" data-src="/pic/icon5.png" alt="Letter">
                            <span class="text_row_cont">info@gems.com.ua</span>
                        </div>
                        <div class="cont_row">
                            <img class="img_row_cont" data-src="/pic/icon4.png" alt="Callback" width="30" height="30">
                            <span class="text_row_cont"><a href="#"
                                                           class="mnu_cb"><?= Yii::t('app', 'Закажите звонок') ?></a></span>
                        </div>
                    </div>
                    <div class="mnu_step chactive_step" id="mnu_s2">
                        <div class="mnu_login">
                            <ul>
                                <li><?= Yii::t('app', 'Добро пожаловать в') ?> Gems.ua</li>
                                <li><a href="/site/login"><?= Yii::t('app', 'Вход') ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mnu_step chactive_step" id="mnu_s3">
                        <div class="mnu_login">
                            <ul>
                                <li><p><?= Yii::t('app', 'Язык') ?></p>

                                    <div class="topHead_right">
                                        <div class="lang">
                                            <?php
                                            //$currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language) + 1);
                                            echo '<a id="ru" href="/ru' . $currentUri . '" class="' . (Yii::$app->language == 'ru' ? 'cur' : '') . ' ">RU</a>
                  <a href="/ru' . $currentUri . '" class="hidden la"></a>
                  <span class="hidd">/</span>';
                                            echo '<a href="/uk' . $currentUri . '" id="ua" class="' . (Yii::$app->language == 'uk' ? 'cur' : '') . ' ">UA</a>
                  <a href="/uk' . $currentUri . '" class="hidden la"></a>';
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <li><p><?= Yii::t('app', 'Выбор валюты') ?>:</p>
                                    <?php
                                    echo '<a class="' . ($curr->code_currency == $currency[0]->code_currency ? 'active' : '') . '" href="/site/currencies?code=' . $currency[0]->code_currency . '&destination=' . $currentUri . '">' . $currency[0]->name_currency . '</a>  / ';;
                                    echo '<a class="' . ($curr->code_currency == $currency[1]->code_currency ? 'active' : '') . '" href="/site/currencies?code=' . $currency[1]->code_currency . '&destination=' . $currentUri . '">' . $currency[1]->name_currency . '</a>   ';;
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="/shop"><?= Yii::t('app', 'Все камни') ?></a>
                        <ul class="nav-drop">
                            <?php
                            echo frontend\components\Menuhelper::getMenuListGems();
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= Yii::t('app', 'Цвета') ?></a>
                        <ul class="nav-drop">
                            <?php
                            echo frontend\components\Menuhelper::getMenuListColors();
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= Yii::t('app', 'Огранки') ?></a>
                        <ul class="nav-drop">
                            <?php
                            echo frontend\components\Menuhelper::getMenuListShapes();
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= Yii::t('app', 'Бренды') ?></a>
                        <ul class="nav-drop">
                            <li><a href="/shop?FilterForm%5Bbrand%5D=Модельные%20камни"><?= Yii::t('app', 'Модельные камни') ?></a></li>
                            <li>
                                <a href="/shop?FilterForm%5Bbrand%5D=Калиброванные вставки Swarovski gemstones"><?= Yii::t('app', 'Калиброванные вставки') ?>
                                    Swarovski Gemstones</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= Yii::t('app', 'Гороскоп') ?></a>
                        <ul class="nav-drop">
                            <li><a href="/pages/rybi"><?= Yii::t('app', 'Рыбы') ?></a></li>
                            <li><a href="/pages/oven"><?= Yii::t('app', 'Овен') ?></a></li>
                            <li><a href="/pages/telets"><?= Yii::t('app', 'Телец') ?></a></li>
                            <li><a href="/pages/bliznetsy"><?= Yii::t('app', 'Близнецы') ?></a></li>
                            <li><a href="/pages/rak"><?= Yii::t('app', 'Рак') ?></a></li>
                            <li><a href="/pages/lev"><?= Yii::t('app', 'Лев') ?></a></li>
                            <li><a href="/pages/deva"><?= Yii::t('app', 'Дева') ?></a></li>
                            <li><a href="/pages/vesy"><?= Yii::t('app', 'Весы') ?></a></li>
                            <li><a href="/pages/skorpion"><?= Yii::t('app', 'Скорпион') ?></a></li>
                            <li><a href="/pages/strelets"><?= Yii::t('app', 'Стрелец') ?></a></li>
                            <li><a href="/pages/kozerog"><?= Yii::t('app', 'Козерог') ?></a></li>
                            <li><a href="/pages/vodoley"><?= Yii::t('app', 'Водолей') ?></a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/shop?FilterForm%5Bexclusive%5D=1"><?= Yii::t('app', 'Эксклюзив') ?></a>
                    </li>
                    <li class="nav-item nav-item__maxw">
                        <a href="/simpleproducts"><?= Yii::t('app', 'Упаковка и Сертификаты') ?></a>
                    </li>

                    <!-- <li class="nav-item hidd">
                         <a href="#"><?= Yii::t('app', 'В подарок') ?></a>
                     </li>
                     <li class="nav-item hidd">
                         <a href="#"><?= Yii::t('app', 'Акции') ?></a>
                     </li>
                     <li class="nav-item hidd">
                         <a href="#"><?= Yii::t('app', 'Опт') ?></a>
                     </li>-->

                </ul>
            </nav>
            <!-- .mainMenu -->
            <div class="clear"></div>
        </div>
    </header>
</section>
<section class="size">
    <style>
    .goroskop{
        display:flex;
        width:100%;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .goroskopCell{
        display:block;
        width: 155px;
        margin:auto;
    }
    .goroskopCharcteristic{
        width:49%;
        font-size: 10pt;
    }
    @media only screen and (max-width: 992px) {
        .goroskopCharcteristic{
            width: 100%;
            margin-top:5px;
            margin-bottom:5px;
        }
    }
    .login_blok{
        background: linear-gradient(to top, #ffffff, #fbf4f7, #d992ad,  #fbf4f7, #ffffff);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 10px;
    }

    .form-group .btn{
        background: #b3265b;
        background: linear-gradient(to bottom, #fbf4f7 0%, #b3265b 36%, #d588a5 100%);
        color: #fff;
        border: 1px solid #333;
        border-radius: 20px;
    }
    .regform input{
        background:  #fff;
        background: linear-gradient(to top, #e8bdce 0%, #fff 36%);
        color: #000;
        border: 1px solid #333;
        border-radius: 20px;
    }
    .RowImgGems{
        width: 150px;
    }
    @media only screen and (max-width: 992px) {
        table.tprice tr{
            border-bottom: 2px solid #c65c84;
        }

        td.RowImgGems, th.RowImgGems{
            width: 40% !important;
        }
        .RowImgGems a{
            display:block;
            vertical-align: middle;
        }

        td.RowWesGems, th.RowWesGems{
            display: none;
            width: 0%;
        }
        td.RowRzmerGems, th.RowRzmerGems{
            vertical-align: middle;
            width: 22% !important;
        }
        td.RowPriceGems, th.RowPriceGems{
            width: 22% !important;
/*            border-bottom: 2px solid #c65c84;              */
        }                                   */
        th.RowButtonGems{
            vertical-align: middle;
        }
        th.RowButtonGems .buttontobuy{
            font-size: 12px;
        }

        td.RowButtonGems{
            display:flex;
            flex-wrap: wrap;
        }

        .RowButtonGems a.minus,.RowButtonGems a.plus, .RowButtonGems input{
            display: block;
            position:relative;
            width:50px;
            margin: 5px auto !important;
            text-align:center;
        }

    }
    @media only screen and (max-width: 992px) {
        .products_inCart{
            width: 100%;
        }

        .product {
            display:flex;
            flex-wrap: wrap;
        }

    }
    </style>
