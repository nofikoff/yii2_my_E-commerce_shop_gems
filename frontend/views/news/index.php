<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Статьи'), 'url' => ['/pages/ArticlesGemstones']];

$this->title = Yii::t('app','Статьи') . " | " . Yii::t('app', 'Магазин драгоценных камней Центури: большой выбор натуральных камней с качественной огранкой');


?>


<div class="news">
       
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $models,
            'itemView'     => '_news_view', 
            'layout'     => '{items}{pager}',
      
        ]); ?>
       
     
            
</div>


