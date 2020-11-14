





<footer id="footer">

    <!--мобильной версии бlок-->
    <div class="warranty_icons hidden">
        <a href="/pages/history" class="w_icon">
            <img data-src="/pic/w1.png" alt="">


            <span class="w_title"><?= Yii::t('app', 'на рынке —<br>с 2002 года') ?></span>
        </a>
        <a href="/pages/naturproduct" class="w_icon">
            <img data-src="/pic/w5.png" alt="">
            <span class="w_title"><?= Yii::t('app', '100% натуральные<br>камни') ?></span>
        </a>
        <a href="/pages/payment" class="w_icon">
            <img data-src="/pic/w4.png" alt="">
            <span class="w_title"><?= Yii::t('app', 'доставка<br>по всей Украине') ?></span>
        </a>
        <a href="/pages/stock" class="w_icon">
            <img data-src="/pic/w3.png" alt="">
            <span class="w_title"><?= Yii::t('app', 'собственный<br>склад') ?></span>
        </a>
        <a href="/pages/exhibition" class="w_icon">
            <img data-src="/pic/w2.png" alt="">
            <span class="w_title"><?= Yii::t('app', 'шоу рум') ?></span>
        </a>
    </div>


    <div class="size">
        <div class="footer_left">
            <div class="copy">
                <p>Copyright 2004-<?=date("Y"); ?></p>

                <p>Gems.ua</p>
            </div>
            <!-- .copy -->
            <div class="fMenu">
                <div class="fMenu_block">
                    <ul>
                        <li><a href="/pages/about"><?= Yii::t('app', 'О нас') ?></a></li>
                        <li><a href="/pages/payment"><?= Yii::t('app', 'Доставка и оплата') ?></a></li>
                    </ul>
                </div>
                <div class="fMenu_block">
                    <ul>
                        <li><a href="/pages/contacts"><?= Yii::t('app', 'Контакты') ?></a></li>


		<li class='mobile_cert'><a href="/pages/sertificate"><?= Yii::t('app', 'Сертификация') ?></a></li>
                <li class='mobile_cert'><a href="/pages/ArticlesGemstones"><?= Yii::t('app', 'Статьи') ?></a></li>

                    </ul>
                </div>
            </div>
            <!-- .fMenu -->
            <div class="fLink">
                <div class="soc_hone">
                    <div class="socShare">
                        <a href="https://www.facebook.com/DragkamniGemsComUa/"><img data-src="/pic/fb.png" alt=""></a>
<!--                        <a href="#"><img data-src="/pic/twitt.png" alt=""></a>-->
                        <a href="https://www.instagram.com/gems_ua/?hl=ru"><img data-src="/pic/insta.png" alt=""></a>
                        <a href="https://plus.google.com/u/0/b/105682185382951937279/105682185382951937279"><img data-src="/pic/google.png" alt=""></a>
                        <a href="https://www.youtube.com/channel/UCCrUKWkfRSc_swwg4WQJmjQ"><img data-src="/pic/youtube.png" alt=""></a>
                    </div>
                    <div class="phone">
                        <p>info@gems.com.ua</p>
                    </div>
                </div>
                <!-- .soc_hone -->
                <div class="subscribe">
                    <?php
                    $subForm = new \frontend\models\SubscribeForm();
                    $form = \kartik\widgets\ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'action' => \yii\helpers\Url::to(['/subscribe/send']),
                    ]);
                    $currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language) + 1);
                    echo \yii\helpers\Html::hiddenInput('successUrl', $currentUri);
                    echo $form->field($subForm, 'email')->input('email', ['placeholder' => 'E-mail'])->label(false);
                    echo \yii\helpers\Html::submitButton(Yii::t('app', 'Подписатся на рассылку'), ['class' => 'btn btn-primary', 'id' => 'subscriber-send']);
                    \kartik\widgets\ActiveForm::end();
                    ?>
                </div>
                <!-- .subscribe -->
            </div>
            <!-- .fLink -->
        </div>
        <!-- .footer_left -->
        <div class="footer_right">
            <div class="working_hours">
                <p><?= Yii::t('app', 'Время работы: пн-пт') ?></p>

                <p>09:00 - 17:00</p>
            </div>
            <!-- .working_hours -->
            <div class="working_hours">
                <p><a href="viber://contact?number=%2B380686606809"><img data-src="/pic/call.png" alt="" height="20px"></a></p>

                <p><a href="tel:(068)660-68-09">(068) 660-68-09</a></p>
            </div>
            <!-- .working_hours -->
        </div>
        <!-- .footer_right -->
        <div class="working_numbers">

<p><a href="tel:(044) 592-14-88">(044) 592-14-88</a></p>
<p><a href="tel:(050) 207-75-54">(050) 207-75-54</a></p>

        </div>
        <!-- .working_hours -->
    </div>
    <!-- .size -->
</footer>
