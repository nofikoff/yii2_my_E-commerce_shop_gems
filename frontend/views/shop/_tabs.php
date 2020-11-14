<style>
.tabs {
    font-size: 0;
/*    max-width: 350px;*/
    margin-left: auto;
    margin-right: auto;
}

.tabs>input[type="radio"] {
    display: none;
}

.tabs>div {
    /* скрыть контент по умолчанию */
    display: none;
    border: 1px solid #e0e0e0;
    padding: 10px 15px;
    font-size: 16px;
}

/* отобразить контент, связанный с вабранной радиокнопкой (input type="radio") */
#tab-btn-1:checked~#content-1,
#tab-btn-2:checked~#content-2,
#tab-btn-3:checked~#content-3 {
    display: block;
}

.tabs>label {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: #f5f5f5;
    border: 1px solid #e0e0e0;
    padding: 2px 8px;
    font-size: 16px;
    line-height: 1.5;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
    cursor: pointer;
    position: relative;
    top: 1px;
}

.tabs>label:not(:first-of-type) {
    border-left: none;
}

.tabs>input[type="radio"]:checked+label {
    background-color: #fff;
    border-bottom: 1px solid #fff;
}
</style>
<div class="tabs">
    <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
    <label for="tab-btn-1"><?= Yii::t('app', 'Все для камня') ?></label>
    <input type="radio" name="tab-btn" id="tab-btn-2" value="">
    <label for="tab-btn-2"><?= Yii::t('app', 'Доставка и оплата') ?></label>
    <input type="radio" name="tab-btn" id="tab-btn-3" value="">
    <label for="tab-btn-3">Видео</label>

    <div id="content-1" class="t_content" style="margin-right: 0px;">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $simple,
                    'itemView' => '_list_simple',
//    'viewParams' => ['shape' => $shape],
                    'layout' => '<ul id="abSt">{items}</ul>',

                    'summary' => '',
                    'itemOptions' => [
                        'tag' => false
                    ],
                    'options' => [
                        'class' => 'aboutStone',
                        'id' => false
                    ]
                ]); ?>
                <button type="button" id="abPrev" class="slick-prev"></button>
                <button type="button" id="abNext" class="slick-next"></button>
                <!-- .aboutStone -->
    </div>
    <div id="content-2">
                <?php
                // редактировать этот блок здесь
                // http://g.new-dating.com/admin/pages/update?id=31
                $modelPages = \common\models\Pages::find()->where(['id' => 31])->one();
                echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};

                ?>
    </div>
<style>
iframe {
    margin: 40px auto 0 auto;
}
.youtube {
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    display: block;
    overflow: hidden;
    transition: all 200ms ease-out;
    cursor: pointer;
    margin: 40px auto 0 auto;
}
.youtube .play {
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAERklEQVR4nOWbTWhcVRTHb1IJVoxGtNCNdal2JYJReC6GWuO83PM/59yUS3FRFARdFlwYP1CfiojQWt36sRCUurRIdVFXIn41lAoVdRGrG1M01YpKrWjiYmaSl8ybZJL3cd+YA//NLObd3++eO8x79z5jSq5Gw+8kov0AP8vMR5l1BtBZQM4B8ks75wCdZdYZZj5qLZ4hov2Nht9Z9vhKKSIaB/gI4M4w62KeAO6Mte4lYOq20FxrlqqOibhHmeWbvNC9ZfDX1mLae391aN6limO/gwgvAPJbWeAZuSDingdwXTBw7/0IsyaA/Fkh+KqOkD+YNfHej1QKD+y7iVlOhgLvFqFfNJvNGyuBJ+KDAF8MDd0tgS8y64OlgSdJMsysL4cG7SOHkyQZLhTee7+d2R2rAVy/S+Jd7/32ouBHAP4gNNRGQyTHc/84NhqNywZp5rvjjnnvt21aABFeCQ+RLwAf2hQ8s7sv9OCLk6AHNgQvIrvbfzKCD76g/O6cu7lf/iER/aQGgy448pExZmhdegAPhR9sObFWH1gT3lp7DaA/5bkIgJhZPgsNmz02novj+KqeApj1ubwXWe4kdyeznAgNvTpE/HQmvKqOMeuFogTUVQSRno+iaLRLAJF7uIgL9O4ubgL8aWgB7S44mNX+35YpICUiAvS9sBLkq1WzT+NFffl6AuoiApi6NT37h6sWkBIRZGkQ8YtLgyji6e1mBYTqCEBPG2Naz+0BWQgtoGoRgCzEsd9hAN1X5BfnFZASUfrSAFQNsyZ1FJASUVpHiLinDJG8U2cBZYogkrcNs5waBAGdstbeU9zdqpw0gPwwSAI6VUxHyFlDpOcHUUBBIuYNs14aZAE5RVwyzPr3/0EAEY0TyfGNjBWQvwZ+CTSbehfAH29mrID8bET0+0EUkAd8WYDOmqJ3ecsG30yr9wqRfm6Y+a1BEFDEjHfHvWmY9ck6CygHvBVr8Xhtb4ZE5HZA3y8DvBNA1TjnrmXWf+sioMwZX5V/VHXMGGMMoKdDCxCRvRWBdzKzdHEO+EisilbPyopHYqp6S9UCAsz4iojI7hUDAtyXVQgIDd6KnOoaWNkbI6FaPSuZGyMArsi7MZoloB4zviI/Nhr3X95jltwTRQmoIfgisy5ai+me67OI7fE4nrqjrqfK1t0eby0FPRB6oGVlchL3rgnfrq19RKbVBdhV9IOSwJmfmJi4vi/4ThERitwyCxVAFqydshuCX5awhQ9KtmuIWd8IDZED/nXT77rvVVv6sHRKwjYi91poqP7Dr+Y6JJ1VSZIMA3wkPNy6bX+o8Bcm0sXMdwM8Fxo0A3xORPaWBp6uPXsmbxCRD0NDL0dOANhVCXy6iAjMcjbcrMt3RITKwdMVRdFo+y5yvkL4eWZ+zHt/ZVD4dEVRNGotpst+dZZZH8k86lqn2pIvT/eqrNfn2xuyqYPZ8mv7s8pfn/8Pybm4TIjanscAAAAASUVORK5CYII=") no-repeat center center;
    background-size: 64px 64px;
    position: absolute;
    height: 100%;
    width: 100%;
    opacity: .8;
    filter: alpha(opacity=80);
    transition: all 0.2s ease-out;
}
.youtube .play:hover {
    opacity: 1;
    filter: alpha(opacity=100);
}
</style>
    <div id="content-3">
        <h3><a href="https://www.youtube.com/channel/UCCrUKWkfRSc_swwg4WQJmjQ">Подпишитесь на наш Youtube канал!</a></h3>
        <div class="youtube" id="WoKgAt5CAM4" style="width:560px;height:315px;"></div>
        <div class="youtube" id="Yj0P7XpAOZI" style="width:560px;height:315px;"></div>
        <div class="youtube" id="6F3_5MgaGmg" style="width:560px;height:315px;"></div>
        <div class="youtube" id="c89-CaI2zn0" style="width:560px;height:315px;"></div>
        <div class="youtube" id="9pEdCvJYFoM" style="width:560px;height:315px;"></div>
    </div>
</div>
    <!-- .tabs -->
