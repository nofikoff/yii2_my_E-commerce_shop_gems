<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => "tree"],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Содержимое сайта',
                        'icon' => 'fa fa-sticky-note-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Ценовые позиции', 'url' => ['/product-gems-prices']],
                            ['label' => 'Лента новостей/Блог', 'url' => ['/news']],
                            ['label' => 'Страницы Инфо разрозн.', 'url' => ['/pages']],
                            ['label' => 'Рассылки', 'url' => ['/mailing']],
                            ['label' => 'Обычные товары', 'url' => ['/simpleproducts']],
                            ['label' => 'Сбросить кэш', 'url' => ['/_cloudflare']],
                        ],
                    ],


                    [
                        'label' => 'Заказы',
                        'icon' => 'fa fa-cart-plus',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Заказы', 'url' => ['/orders']],
                            ['label' => 'Покупатели', 'url' => ['/user']],
                        ],
                    ],


                    [
                        'label' => 'Справочники',
                        'icon' => 'fa fa-book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Сущности ТИП+ЦВЕТ (описание + фото)', 'url' => ['/products-type-color-variation']],
                            ['label' => 'Типы', 'url' => ['/product-type']],
                            ['label' => 'Группы цветов', 'url' => ['/products-color-group']],
                            ['label' => 'Цвета', 'url' => ['/products-colors']],
                            ['label' => 'Формы огранки', 'url' => ['/products-shapes']],
//                            '<li class="divider"></li>',

//                            ['label' => 'Фотогаллерея для Типов камней', 'url' => ['/products-type-multimedia']],
//                            ['label' => 'Фото для Сущности(Тип+Цвет) и Формы', 'url' => ['/products-type-color-multimedia']],
                            ['label' => 'Фото для Ценовых позиций', 'url' => ['/products-multimedia']],

//                            '<li class="divider"></li>',


                            ['label' => 'Группа наценки', 'url' => ['/product-price-group']],
                            ['label' => 'Валюты', 'url' => ['/currencies']],
                            ['label' => 'Страны', 'url' => ['/products-countries']],
                            ['label' => 'Акционные цены', 'url' => ['/products-sales']],
                        ],
                    ],


                    [
                        'label' => 'Парсер 1с - вебсайт',
                        'icon' => 'fa fa-book',
                        'url' => '#',

                        'items' => [
                            ['label' => 'ТИПЫ камней - варианты написания 1c', 'url' => ['/parser-gemstypes']],
                            ['label' => 'ЦВЕТА камней - варианты написания 1c', 'url' => ['/parser-gemscolors']],
                            ['label' => 'ОГРАНКИ камней - варианты написания 1c', 'url' => ['/parser-gemshapes']],
                            ['label' => 'БРЕНДЫ камней - варианты написания 1c', 'url' => ['/site/brands']],
                            ['label' => 'ЗАРЕЗЕРВИРОВАННЫЕ слова названих камней (суфиксы)', 'url' => ['/parser-gemstype-reservedkeys']],
                            ['label' => 'ЦВЕТ ПО ДЕФОЛТУ для некоторых типов камней', 'url' => ['/parser-gemscolors-defaulttype']],
                            ['label' => 'ЕДИНИЦЫ ИЗМЕРЕНИЯ варианты написания', 'url' => ['/options/update?id=6']],
                            ['label' => 'ПРОЧИЙ МУСОР варианты написания (облегчает парсинг)', 'url' => ['/options/update?id=7']],
                            ['label' => 'ОКНО разбора строк 1с -> экпорт в Excel', 'url' => ['/test']],
                            ['label' => 'ФОРМА импорт/сохранения а БД прайса из Excel', 'url' => ['/product-gems-prices/upload']],
                            ['label' => 'Выгрузить в Excell ЭКСКЛЮЗИВ', 'url' => ['/product-gems-prices/export']],

                        ],
                    ],


                    [
                        'label' => 'Настройки',
                        'icon' => 'fa fa-book',
                        'url' => ['/options'],

                    ],


                ],
            ]
        ) ?>

    </section>

</aside>
