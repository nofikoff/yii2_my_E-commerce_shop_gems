<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Корзина');
$this->params['breadcrumbs'][] = $this->title;


$curr = Yii::$app->currency->getCurrency();
?>

<?php if ($total != 0) : ?>

    <div class="xxxx">

        <!--				<div class="fTitle">Ваша корзина:</div>-->
        <!--				<div class="cart_more">-->
        <!--					<span>Всего товаров в корзине: 6</span>-->
        <!--					<span>Общая сумма покупок: <span class="color">1800 грн</span></span>-->
        <!--					<span>В том числе НДС 20%, <b>360 грн</b></span>-->
        <!--				</div>-->
        <div class="cart_tab_blok">
            <div class="cart_tabs">
                <div id="tab1" class="cart_tab active_tab">
                    <p><?= Yii::t('app', 'Вы выбрали') ?></p>
                    <img src="/pic/tab_border.png" alt="">
                </div>
            </div>

            <script>
                function add(id) {
                    var a = $("#noOfRoom" + id).val();
                    a++;
                    if (a && a >= 1) {
                        $("#subs" + id).removeAttr("disabled");
                    }
                    $("#noOfRoom" + id).val(a);
                    return false;
                }
                ;

                function subst(id) {
                    var b = $("#noOfRoom" + id).val();
                    // this is wrong part
                    if (b && b >= 1) {
                        b--;
                        $("#noOfRoom" + id).val(b);
                    }
                    else {
                        $("#subs" + id).attr("disabled", "disabled");
                    }
                    return false;
                }
                ;
            </script>


            <div class="products_inCart">
                <div id="step1">
                    <?php $form = ActiveForm::begin(); ?>
                    <?php


                    foreach ($positions as $position) {

                        if (!isset($position->product)) continue;
                        ?>
                        <div class="product">
                            <div class="product_grid">

                                <?php
                                if ($position->type == 'gems') {

                                    echo '<div class="imgcart"><a href="/shop/gems?id=' . $position->product->id . '">' .
                                        Html::img($position->product->thumb(50, 70)) . '</a>
                    </div>
                    <div class="desc">
                        <h4><a href="/shop/gems?id=' . $position->product->id . '">' . $position->name . '</a></h4>
                        <p>' . number_format($position->product->size_h, 2, '.', ' ') . (($position->product->size_w != '0.00') ? ' x ' . number_format($position->product->size_w, 2, '.', ' ') : '') . (($position->product->size_d != '0.00') ? ' x ' . number_format($position->product->size_d, 2, '.', ' ') : '') . ' мм</p>
                    </div>';

                                } else {

                                    echo '<div class="imgcart"><a href="/simpleproducts">' .
                                        Html::img($position->product->thumb(50, 70)) . '</a>
                    </div>
                    <div class="desc">
                        <h4><a href="/simpleproducts">' . $position->name . '</a></h4>
                    </div>';


                                }
                                ?>
                            </div>
                            <div class="product_grid">
                                <p class="small"><?= Yii::t('app', 'Цена за 1 шт.') ?></p>
                                <p class="price"><?= number_format($position->price, 2, ',', ' ') . ' ' . $curr->name_currency ?></p>
                            </div>
                            <div class="product_grid quantity">
                                <p class="small"><?= Yii::t('app', 'Кол-во, шт.') ?></p>
                                <a href="#" class="minus" id="subs<?= $position->product->id ?>" onclick="return subst(<?= $position->product->id ?>)"><img src="/pic/minus.png" alt=""></a>
                                <input type="text" id="noOfRoom<?= $position->product->id ?>" name="quantity[<?= (($position->type == 'simple') ? $position->type : '') . $position->product->id ?>]" value="<?= $position->quantity ?>"/>
                                <a href="#" class="plus" id="adds<?= $position->product->id ?>" onclick="return add(<?= $position->product->id ?>)"><img src="/pic/plus.png" alt=""></a>
                            </div>
                            <div class="product_grid">
                                <p class="small"> <?= Yii::t('app', 'Всего') ?></p>
                                <p class="price"><?= number_format(($position->quantity * $position->price), 2, ',', ' ') . ' ' . $curr->name_currency ?></p>
                            </div>
                            <div class="product_grid remove">
                                <a href="<?= Yii::$app->urlManager->createUrl(['shop/delete', 'id' => $position->id, 'type' => $position->type]) ?>" class="card-remove__btn btn btn-success"><img src="/pic/re.png" alt=""></a>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <!--                <div id="step2" class="cart_form tab_hidden">-->
                <!--                </div>-->
                <!--                <div id="step3" class="itog tab_hidden">-->
                <!--                </div>-->
            </div>

            <div class="cart-row row">
                <div class="col-xs-5 left">
                        <a href="." id="ghgh" class="btn mnj"><?= Yii::t('app', 'Продолжить покупки') ?></a>
                </div>
                <div class="col-xs-7 right">
                    <?= Html::submitButton(Yii::t('app', 'Обновить'), ['class' => 'btn-update btn btn-primary']); ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <div class="cart-row row">
                <div class="col-xs-7">
                    &nbsp;
                </div>
                <div class="right col-xs-5">
<!--                    <div class="cart_info_text">-->
                        <h1><?= Yii::t('app', 'Общая сумма') ?>: <strong><span
                                        class="color"><?= number_format($total, 2, ',', ' ') . ' ' . $curr->name_currency ?></span></strong>
                        </h1>
                        <p><?= Yii::t('app', 'В том числе НДС 20%') ?>:
                            <strong><?= number_format(($total * 20 / 100), 2, ',', ' ') . ' ' . $curr->name_currency ?></strong>
                        </p>

<!--                    </div>-->
                </div>
            </div>

            <div class="cart-row row">
                <div class="col-xs-1">
                    &nbsp;
                </div>
                <div class="col-xs-11">
                    <center>
<!--                        Ваша стоимость доставки 100 грн, добавьте позиции на сумму 43$ и стоимость доставки составит 45 грн-->
                    </center>
                </div>
            </div>
            <div class="cart-row row">
                <div class="col-xs-5  left_blok">
                    <div class="postblock">
                        <?php
                        // ина о доставке
                        // редактировать этот блок здесь
                        // http://g.new-dating.com/admin/pages/update?id=30
                        $modelPages = \common\models\Pages::find()->where(['id' => 33])->one();
                        echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};
                        ?>
                    </div>


                </div>
                <div class=" col-xs-7   right_blok">
                    <div class="fast_order">
                        <?php

                        if (Yii::$app->user->isGuest) {


                            echo '';
                            // для наонгнимсу предложенеи зарегаться и пр муйня
                            if (Yii::$app->user->isGuest) {
                                // редактировать этот блок здесь
                                // http://g.new-dating.com/admin/pages/update?id=30
                                $modelPages = \common\models\Pages::find()->where(['id' => 32])->one();
                                echo "<h4>" . $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')} . "</h4>";
                            }
                            echo "";

                            echo "<h1>" . Yii::t('app', 'Быстрый заказ') . "</h1>";

                        }

                        $form = ActiveForm::begin([
                            'action' => Url::to(['/shop/checkout'])
                        ]);

                        if (Yii::$app->user->isGuest) {

                            echo $form->field($model, 'name')->Label(Yii::t('app', 'Имя'));
                            echo $form->field($model, 'phone')->Label(Yii::t('app', 'Телефон'));


                            echo $form->field($model, 'address')->hiddenInput(['value' => 'NO ADDRESS'])->label(false);
                            echo $form->field($model, 'email')->hiddenInput(['value' => 'noemail@noemail.com'])->label(false);
                            echo $form->field($model, 'comment')->textarea()->hiddenInput(['' => 'abc value'])->label(false);

                        } else {

                            echo $form->field($model, 'name')->Label(Yii::t('app', 'Имя'));
                            echo $form->field($model, 'address')->Label(Yii::t('app', 'Адрес доставки'));
                            echo $form->field($model, 'email')->Label(Yii::t('app', 'E-mail'));
                            echo $form->field($model, 'phone')->Label(Yii::t('app', 'Телефон'));
                            echo $form->field($model, 'comment')->Label(Yii::t('app', 'Комментарий к заказу'))->textarea();

                        }
                        ?>
                        <div class="fast">
                            <?php
                            echo Html::submitButton(Yii::t('app', 'Заказать'), ['class' => 'btn btn-primary']);
                            if (Yii::$app->user->isGuest) {
                                echo "<h4>" . Yii::t('app', 'Укажите ваши Имя и Телефон и мы перезвоним вам') . "</h4>";
                            }

                            ?>
                        </div>
                        <?php
                        ActiveForm::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


<?php else:

    echo '<h2>' . Yii::t('app', 'Корзина пуста') . '</h2>';

endif; ?>

