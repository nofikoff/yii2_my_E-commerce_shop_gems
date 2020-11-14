<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '7days',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // $menuItems = [
    //     ['label' => 'Новости', 'url' => ['/news']],
    // ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Содержимое сайта',
            'items' => [
                ['label' => 'Управление ценовыми позициями', 'url' => ['/product-gems-prices']],
                ['label' => 'Управление лентой новостей', 'url' => ['/news']],
                ['label' => 'Управление страницами', 'url' => ['/pages']],
                ['label' => 'Управление рассылками', 'url' => ['/mailing']],
                ['label' => 'Управление обычными товарами', 'url' => ['/simpleproducts']],
            ],
        ];
        $menuItems[] = ['label' => 'Заказы',
            'items' => [
                ['label' => 'Заказы', 'url' => ['/orders']],
                ['label' => 'Покупатели', 'url' => ['/user']],
            ],
        ];
        $menuItems[] = ['label' => 'Справочники',
            'items' => [
                ['label' => 'Тип камня', 'url' => ['/product-type']],
                ['label' => 'Группы цветов камня', 'url' => ['/products-color-group']],
                ['label' => 'Цвет камня', 'url' => ['/products-colors']],
                ['label' => 'Описание ТИП+ЦВЕТ', 'url' => ['/products-type-color-variation']],
                ['label' => 'Группа наценки', 'url' => ['/product-price-group']],
                ['label' => 'Валюты', 'url' => ['/currencies']],
                ['label' => 'Формы огранки', 'url' => ['/products-shapes']],
                ['label' => 'Страны', 'url' => ['/products-countries']],
                ['label' => 'Управление акционными ценами', 'url' => ['/products-sales']],
            ],
        ];

        $menuItems[] = [
            'label' => 'Настройки', 'url' => ['/admin/settings']
        ];

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 7days <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
