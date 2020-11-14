<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;


// ВНИМАНИЕ ЭТО СТРАНИЦА ВСЕ КАМНИ, тут нахроен не нужен фильтр
//$b = $filterForm->getListFilters();
//$a = $b ? '<span>' . Yii::t('app', 'Отфильтрованы по') . ': ' . $b . '</span> ' : '';
//echo "<div class='filterBredcrubs' template='shop\index'>" . $a . "</div>";

$this->title = Yii::t('app', 'Драгоценные камни магазина Центури | Цена, фото, вес, форма, огранка, стоимость камня за карат');


// первый символ заглавным
$fc = mb_strtoupper(mb_substr($this->title, 0, 1, 'utf-8'), 'utf-8');
$this->title = $fc . mb_substr($this->title, 1, 999, 'utf-8');
?>
<!--template shop/index.php-->

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'viewParams' => ['shape' => $shape],
    'layout' => "<div class='catalogList'>{items}</div>{pager}",

]); ?>


<div class="seo-block">
                <?php
                // редактировать этот блок здесь
                // http://g.new-dating.com/admin/pages/update?id=31
                $modelPages = \common\models\Pages::find()->where(['id' => 41])->one();
                if (isset($modelPages)) echo $modelPages->{"content_" . (Yii::$app->language=='uk'?'ua':'ru')};

                ?>
</div>


