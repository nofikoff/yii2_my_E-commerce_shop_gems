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