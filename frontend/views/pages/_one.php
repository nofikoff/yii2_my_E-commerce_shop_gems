<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

//$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['/pages']];
$this->params['breadcrumbs'][] = $model->{"name_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')};

foreach ($this->params['breadcrumbs'] as $a) {
    if (isset($a['label'])) {
        $this->title .= ' | ' . $a['label'];
    } else {
        $this->title .= ' | ' . $a;
    }
}
$a = trim($this->title, ' |');
$this->title = $a . " | " . Yii::t('app', 'Магазин драгоценных камней Центури: большой выбор натуральных камней с качественной огранкой');

?>

<div class="pages-view">
    <h1><?= Html::encode($a) ?></h1>

    <?= $model->{"content_" . (Yii::$app->language == 'uk' ? 'ua' : 'ru')}; ?>

</div>

