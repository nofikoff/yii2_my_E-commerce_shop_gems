<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$b = $filterForm->getListFilters();
$a = $b ? '<span>' . Yii::t('app', 'Отфильтрованы по') . ': ' . $b . '</span> ' : '';
echo "<div class='filterBredcrubs' template='shop\index-gem'>" . $a . "</div>";

$this->params['breadcrumbs'][] = strip_tags($b);
$this->title = strip_tags(Yii::t('app', 'купить').' '.$b)
    // ЭТО НЕ ГОДИТСЯ ЕСТЬ ТУТ ФИЛЬТР ПО ЦВЕТАМ !!! .' | '.Yii::t('app', 'Все цвета и огранки')
    . ' | ' . Yii::t('app', 'Все драгоценные камни данного типа в магазине Центури')
    . ' | ' . Yii::t('app', 'Цена, фото, вес, форма, огранка, стоимость камня за карат');


// первый символ заглавным
$fc = mb_strtoupper(mb_substr($this->title, 0, 1, 'utf-8'), 'utf-8');
$this->title = $fc . mb_substr($this->title, 1, 999, 'utf-8');


?>
<!--template shop/ index-gem.php -->
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list_gem',
    'viewParams' => ['shape' => $shape],
    'layout' => "<div class='catalogList'>{items}</div>{pager}",

]); ?>


<div class="content read">
    <?php
    $get = Yii::$app->request->get('FilterForm');

    // ЦВЕТ
    if ((isset($get['color']) && is_numeric($get['color'])) AND sizeof($get) == 1) {
        $color = \common\models\ProductsColorGroup::find()
            ->where(['id_color_group' => $get['color']])
            ->One();
        if ($color) echo $color->{'seo_' . Yii::$app->language};
    }
    // ТИП КАМНЯ
    if ((isset($get['type']) && is_numeric($get['type'])) AND sizeof($get) == 1) {
        $color = \common\models\ProductsTypeDesc::find()
            ->where(['product_type_id' => $get['type']])
            ->One();
        if ($color) echo $color->{'desc_products' . (Yii::$app->language == 'uk' ? '_ua' : '')};
    }


    ?>
</div>

<div class="seo-block">
    <?php
    // только для одиночных параметров
    if (sizeof($_GET) == 1) {
        // ВНИМНИЕ ЭТА ФОРМА ОГРАНУИ В БЛОГЕ В НОВОСТЯХ
        if (isset($_GET['FilterForm']['shape'])) {
                $modelPages = \common\models\ProductsShapes::find()->where(['id_shape' => $_GET['FilterForm']['shape']])->one();
                if (isset($modelPages)) echo $modelPages->{"desc_" . Yii::$app->language};


//            // каког то хера Кабошон имеетт свою статью ;)
//            if ($_GET['FilterForm']['shape'] == 16) {
//                $modelPages = \common\models\News::find()->where(['id' => 34])->one();
//                if (isset($modelPages)) echo $modelPages->{"content" . (Yii::$app->language == 'uk' ? '_ua' : '')};
//            }
        }

        // ЭТИ В ДРУГОЙ МОДЕЛИ В СТАТЬЯХ
        if (isset($_GET['FilterForm']['exclusive']) AND $_GET['FilterForm']['exclusive'] == 1) {
            $modelPages = \common\models\Pages::find()->where(['id' => 44])->one();
            if (isset($modelPages)) echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};
        }
        if (isset($_GET['FilterForm']['brand']) AND $_GET['FilterForm']['brand'] == 'Модельные камни') {
            $modelPages = \common\models\Pages::find()->where(['id' => 43])->one();
            if (isset($modelPages)) echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};
        }
        if (isset($_GET['FilterForm']['brand']) AND $_GET['FilterForm']['brand'] == 'Калиброванные вставки Swarovski gemstones') {
            $modelPages = \common\models\Pages::find()->where(['id' => 42])->one();
            if (isset($modelPages)) echo $modelPages->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};
        }
    }
    ?>
</div>
