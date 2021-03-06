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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/']],
        ['label' => 'Статьи', 'url' => ['/news']],
        ['label' => 'Товары', 'url' => ['/shop']],
        ['label' => 'Сопутствующие товары', 'url' => ['/simpleproducts']],
        ['label' => 'Страницы', 'url' => ['/pages']],
        ['label' => 'Корзина', 'url' => ['/shop/cart']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Профиль', 'url' => ['/shop/user']];
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
        
        <div class="language">
        <?php
            $currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language)+1 );
            echo '<a href="/ru'.$currentUri.'">Русский</a>   ';
            echo '<a href="/uk'.$currentUri.'">Украинский</a>';
        ?>
        </div> 
    
        <div class="currencies">
        <?php
            $currentUri = substr(\yii\helpers\Url::current(), strlen(Yii::$app->language)+1 );
            $curr = Yii::$app->currency->getCurrency();
            $currencies = \common\models\Currencies::find()->all();
            foreach ($currencies as $currency) {
                echo '<a class="'.($curr->code_currency == $currency->code_currency?'active':'').'" href="/site/currencies?code='.$currency->code_currency.'&destination='.$currentUri.'">'.$currency->code_currency.'</a>   ';;
            }
        ?>
        </div>


        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => Yii::t('app', 'Драгоценные камни'), 'url' => '/shop'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
        <div class="row">
            <div class="col-md-3 ">
                <div class="well well-sm">
                    <?php
                        $filterForm = new FilterForm();
                        $filters = null;
                        if($filterForm->load(Yii::$app->request->get()) && $filterForm->validate()) {
                        }

                        if (Yii::$app->controller->id == 'shop' && Yii::$app->controller->action->id == 'item') {
                            $item_id = Yii::$app->controller->actionParams['id'];
                            if (is_numeric($item_id)) {
                                $model_color = \common\models\ProductsTypeColorVariation::findOne($item_id);
                                $filterForm['type'] = $model_color->type_product_id;
                                $filterForm['color'] = $model_color->colorProduct->colorGroup->id_color_group;
                            }
                        }

                    ?>            
                    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/shop'])]); ?>
                    <?= $form->field($filterForm, 'type')->dropDownList(ArrayHelper::merge(['0' => 'все'],ArrayHelper::map(\common\models\ProductType::find()->where("`status_disabled` = 0")->orderBy('name_product_type')->all(), 'id_product_type', 'name'))) ?>
                    <?= $form->field($filterForm, 'color')->dropDownList(ArrayHelper::merge(['0' => 'все'],ArrayHelper::map(\common\models\ProductsColorGroup::find()->orderBy('name_color_group')->all(), 'id_color_group', 'name'))) ?>
                    <?= $form->field($filterForm, 'shape')->dropDownList(ArrayHelper::merge(['0' => 'все'],ArrayHelper::map(\common\models\ProductsShapes::find()->orderBy('name_shape')->all(), 'id_shape', 'name'))) ?>
                    <?= $form->field($filterForm, 'action')->checkbox() ?>                  
                    <?= $form->field($filterForm, 'exclusive')->checkbox() ?>
                    <?= $form->field($filterForm, 'this_is_nabor')->checkbox() ?>
                    <?= $form->field($filterForm, 'treatment_type')->dropDownList([ 0 => 'любая', 1 => 'ручная огранка/обработка', 2 => 'машинная огранка/ обработка']) ?>
                    <?= $form->field($filterForm, 'priceFrom') ?>
                    <?= $form->field($filterForm, 'priceTo') ?>
                    <?= $form->field($filterForm, 'height') ?>
                    <?= $form->field($filterForm, 'width') ?>
                    <?= $form->field($filterForm, 'key') ?>
                    
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-md-8 ">
                <?= $content ?>
            </div>
        </div>

    </div>
</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>






