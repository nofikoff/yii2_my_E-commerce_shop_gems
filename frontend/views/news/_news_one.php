<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

//$this->title = $model->name;
//$model->{"name_".Yii::$app->language};
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Статьи'), 'url' => ['/pages/ArticlesGemstones']];
$this->params['breadcrumbs'][] = $model->{'name'.(Yii::$app->language == 'uk' ? '_ua' : '')};

foreach ($this->params['breadcrumbs'] as $a) {
    if (isset($a['label']))
    {
        $this->title .= ' | ' . $a['label'];
    }    else {
        $this->title .= ' | ' .$a;
    }
}
$a = trim($this->title, ' |');
$this->title = $a . " | " . Yii::t('app', 'Магазин драгоценных камней Центури, Киев');



?>


<div class="pages-view">

    <h1><?= Html::encode($model->{'name'.(Yii::$app->language == 'uk' ? '_ua' : '')}) ?></h1>

<!--    --><?//= $model->{"content_".Yii::$app->language}; ?>
    <?= $model->{"content".(Yii::$app->language == 'uk' ? '_ua' : '')}; ?>

</div>

