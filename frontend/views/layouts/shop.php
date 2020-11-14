<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\models\FilterForm;
use frontend\models\SubscribeForm;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


AppAsset::register($this);

$this->registerCssFile('/css/ui-lightness/jquery-ui-1.10.1.min.css');


echo $this->render('/layouts/header', [
    //'model' => $model,
]);
?>


<div id="conteiner">

    <?= Alert::widget() ?>
    <div id="sticky-filter" class="sticky-filter"><a href="#" class="button7">отфильтровать</a></div>
    <div class="leftBlock">
        <div class="filter filterCat">
            <div class="filtTL"></div>
            <div class="filtBL"></div>
            <div class="filtTR"></div>
            <div class="filtBR"></div>
            <div class="filterContent">
                <div class="filterIn">
                    <?php
                    //                    Yii::$app->controller->filterForm = new FilterForm();
                    //                    $filters = null;
                    //                    if (Yii::$app->controller->filterForm->load(Yii::$app->request->get()) && Yii::$app->controller->filterForm->validate()) {
                    //                    }
                    //                    if (Yii::$app->controller->id == 'shop' && Yii::$app->controller->action->id == 'item') {
                    //                        $item_id = Yii::$app->controller->actionParams['id'];
                    //                        if (is_numeric($item_id)) {
                    //                            $model_color = \common\models\ProductsTypeColorVariation::findOne($item_id);
                    //                            Yii::$app->controller->filterForm->type = $model_color->type_product_id;
                    //                            Yii::$app->controller->filterForm->color= $model_color->colorProduct->colorGroup->id_color_group;
                    //                        }
                    //                    }
                    //
                    //                    print_r(Yii::$app->controller->filterForm->color);
                    ?>


                    <?php

                    ////////////////////////
                    //
                    //
                    $form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/shop'])]); ?>


                    <div class="filterBlock">
                        <?php
                        // бля сортировки разные в названиях камней так точно
                        if (Yii::$app->language == 'ru') echo $form->field(Yii::$app->controller->filterForm, 'type')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductType::find()->where("`status_disabled` = 0")->orderBy('name_product_type')->all(), 'id_product_type', 'name')));
                        else echo $form->field(Yii::$app->controller->filterForm, 'type')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductType::find()->where("`status_disabled` = 0")->orderBy('name_product_type_ua')->all(), 'id_product_type', 'name'))); ?>
                    </div>

                    <div class="filterBlock">
                        <?php
                        if (Yii::$app->language == 'ru')
                            echo $form->field(Yii::$app->controller->filterForm, 'shape')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductsShapes::find()->where("`status_disabled` = 0")->orderBy('name_shape')->all(), 'id_shape', 'name')));
                        else     echo $form->field(Yii::$app->controller->filterForm, 'shape')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductsShapes::find()->where("`status_disabled` = 0")->orderBy('name_shape_ua')->all(), 'id_shape', 'name')));

                        ?>
                    </div>

                    <div class="filterBlock">
                        <?php
                        if (Yii::$app->language == 'ru')
                            echo $form->field(Yii::$app->controller->filterForm, 'color')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductsColorGroup::find()->orderBy('name_color_group')->all(), 'id_color_group', 'name')));
                        else echo $form->field(Yii::$app->controller->filterForm, 'color')->dropDownList(ArrayHelper::merge(['0' => Yii::t('app', 'все')], ArrayHelper::map(\common\models\ProductsColorGroup::find()->orderBy('name_color_group_ua')->all(), 'id_color_group', 'name'))); ?>
                    </div>


                    <div class="filterBlock priceblock clearfix">
                        <div class="topLine_filter"><?= Yii::t('app', 'Цена') ?></div>
                        <div class="slider">
                            <div class="frto clearfix">
                                <div class="ftL"><?= Yii::t('app', 'от') ?>


                                    <?php
                                    $curr = Yii::$app->currency->getCurrency();
                                    $max_price = \Yii::$app->params['maxPriceinUSAforFilters'] / Yii::$app->currency->getCurrency()->course_currency;
                                    $max_price = floor($max_price / 1000) * 1000;

                                    $priceFrom = isset(Yii::$app->controller->filterForm->priceFrom) ? Yii::$app->controller->filterForm->priceFrom : 0;
                                    $priceTo = (Yii::$app->controller->filterForm->priceTo > 0) ? Yii::$app->controller->filterForm->priceTo : $max_price;
                                    ?>
                                    <?php //= Yii::$app->controller->filterForm->priceFrom ?>
                                    <input type="hidden" name="FilterForm[priceFrom]" value="<?= $priceFrom ?>">
                                    <span
                                            class="priceformat"><?= $priceFrom ?></span> <?= Yii::$app->currency->getCurrency()->name_currency ?>
                                </div>

                                <div class="ftR"><?= Yii::t('app', 'до') ?>
                                    <input type="hidden" name="FilterForm[priceTo]" value="<?= $priceTo ?>">
                                    <span
                                            class="priceformat"><?= $priceTo ?></span> <?= Yii::$app->currency->getCurrency()->name_currency ?>
                                </div>
                            </div>
                            <div id="slider" data-max="<?= $max_price ?>"></div>
                        </div>
                    </div>


                    <div class="filterBlock" id="size-blok">
                        <div class="topLine_filter"><?= Yii::t('app', 'Размеры огранок') ?></div>
                        <!--                        <form action="" class="size_blok">-->
                        <p class="size_title"><?= Yii::t('app', 'Точный размер или диапазон') ?>, мм</p>

                        <div class="size_img">
                            <img src="/pic/size.png" alt="">

                            <?= $form
                                ->field(Yii::$app->controller->filterForm, 'height',
                                    [
                                        'inputOptions' => ['autofocus' => 'autofocus', 'maxlength' => 10, 'id' => 'height']
                                    ]
                                )
                                ->textInput()
                                ->input('height', ['placeholder' => "0.1-10"])
                                ->label(false); ?>

                            <?= $form
                                ->field(Yii::$app->controller->filterForm, 'width',
                                    [
                                        'inputOptions' => ['autofocus' => 'autofocus', 'maxlength' => 10, 'id' => 'width']
                                    ]
                                )
                                ->textInput()
                                ->input('width', ['placeholder' => "0.1-10"])
                                ->label(false); ?>

                        </div>
                        <!--                        </form>-->
                    </div>
                    <!-- .filterBlock --

                    <div class="filterBlock">
                        <div class="topLine_filter">Тип огранки</div>
                        <div class="cutType">
                            <p class="act">Машинная</p>

                            <div class="switch"><span></span></div>
                            <p>Ручная</p>
                        </div>
                    </div>
                    -- .filterBlock -->


                    <!-- .filterBlock -->
                    <div class="filterBlock">
                        <?= $form->field(Yii::$app->controller->filterForm, 'treatment_type')->dropDownList(\Yii::$app->params['treatment_type_' . Yii::$app->language]) ?>
                    </div>


                    <div class="filterBlock extra">
                        <div class="topLine_filter"><?= Yii::t('app', 'Полезное') ?></div>
                        <div class="filterZodiac">
                            <div class="fCut">
                                <div
                                        class="p4"><?= $form->field(Yii::$app->controller->filterForm, 'action')->checkbox() ?></div>
                            </div>
                            <div class="fCut">
                                <div
                                        class="p2"><?= $form->field(Yii::$app->controller->filterForm, 'this_is_nabor')->checkbox() ?></div>
                            </div>
                            <div class="fCut">
                                <div
                                        class="p3"><?= $form->field(Yii::$app->controller->filterForm, 'exclusive')->checkbox() ?></div>
                            </div>
                            <div class="fCut">
                                <div
                                        class="p5"><?= $form->field(Yii::$app->controller->filterForm, 'instock')->checkbox() ?></div>
                            </div>
                        </div>
                    </div>

                    <? //= $form->field(Yii::$app->controller->filterForm, 'key') ?>
                    <?= Html::submitButton(Yii::t('app', 'Искать'), ['class' => 'filter2Btn']) ?>
                    <?php ActiveForm::end(); ?>
                    <!-- .filterBlock -->
                    <br>
                    <hr>
                    <div class="filterBlock">
                        <div class="topLine_filter"><?= Yii::t('app', 'Гороскоп') ?></div>
                        <div class="filterZodiac">
                            <!--                            <div class="fCut"><span class="z1"><a ><a href="/pages/oven">Овен</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z7"><a ><a href="/pages/vesy">Весы</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z2"><a ><a href="/pages/telets">Телец</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z8"><a ><a href="/pages/skorpion">Скорпион</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z3"><a ><a href="/pages/bliznetsy">Близнецы</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z9"><a ><a href="/pages/strelets">Стрелец</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z4"><a ><a href="/pages/rak">Рак</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z10"><a ><a href="/pages/kozerog">Козерог</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z5"><a ><a href="/pages/lev">Лев</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z11"><a ><a href="/pages/vodoley">Водолей</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z6"><a ><a href="/pages/deva">Дева</a></span></div>-->
                            <!--                            <div class="fCut"><span class="z12"><a ><a href="/pages/rybi">Рыбы</a></span></div>-->

                            <div class="fCut"><span class="z1"><a
                                            href="/pages/oven"><?= Yii::t('app', 'Овен') ?></a></span></div>
                            <div class="fCut"><span class="z2"><a href="/pages/telets"><?= Yii::t('app', 'Телец') ?></a></span>
                            </div>
                            <div class="fCut"><span class="z3"><a
                                            href="/pages/bliznetsy"><?= Yii::t('app', 'Близнецы') ?></a></span></div>
                            <div class="fCut"><span class="z4"><a
                                            href="/pages/rak"><?= Yii::t('app', 'Рак') ?></a></span></div>
                            <div class="fCut"><span class="z5"><a
                                            href="/pages/lev"><?= Yii::t('app', 'Лев') ?></a></span></div>
                            <div class="fCut"><span class="z6"><a
                                            href="/pages/deva"><?= Yii::t('app', 'Дева') ?></a></span></div>
                            <div class="fCut"><span class="z7"><a
                                            href="/pages/vesy"><?= Yii::t('app', 'Весы') ?></a></span></div>
                            <div class="fCut"><span class="z8"><a
                                            href="/pages/skorpion"><?= Yii::t('app', 'Скорпион') ?></a></span></div>
                            <div class="fCut"><span class="z9"><a
                                            href="/pages/strelets"><?= Yii::t('app', 'Стрелец') ?></a></span></div>
                            <div class="fCut"><span class="z10"><a
                                            href="/pages/kozerog"><?= Yii::t('app', 'Козерог') ?></a></span></div>
                            <div class="fCut"><span class="z11"><a
                                            href="/pages/vodoley"><?= Yii::t('app', 'Водолей') ?></a></span></div>
                            <div class="fCut"><span class="z12"><a
                                            href="/pages/rybi"><?= Yii::t('app', 'Рыбы') ?></a></span></div>


                        </div>
                    </div>

                </div>
                <!-- .filterIn -->
            </div>
            <!-- .filterContent -->
            <div class="filterBtn">
                <div class="fB_TR"></div>
                <div class="fB_BR"></div>
                <img class="expand_btn" src="/pic/expand.png" alt="">
                <img class="turn_btn" src="/pic/turn.png" alt="">
            </div>
            <!-- .filterBtn -->



        </div>
        <!-- .filter -->

    </div>
    <!-- .leftBlock -->
    <div class="rightBlock">
        <div class="breadcrumbs clearfix">
            <div style="display:flex;flex-wrap: wrap;justify-content: space-between;">
            <div class="prebread">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => Yii::t('app', 'Драгоценные камни'), 'url' => '/shop'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            </div>
            <?php
                echo "<div class='myfb02'>".$this->render('/news/_top_facebook_likebox')."</div>";
            ?>
            </div>
        </div>


        <?= Alert::widget() ?>


        <!--start content-->

        <?= $content ?>

        <!--start content-->

    </div>
    <!-- .rightBlock -->
</div>

</section>

<?= $this->render('/layouts/footer', [
    //'model' => $model,
]) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $(function () {
        $(".form-control").change(function () {
            $("form#w2").submit();
        });
        $("input:checkbox").change(function () {
            $("form#w2").submit();
        });
    });
</script>
