
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